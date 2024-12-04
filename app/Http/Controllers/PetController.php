<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetOwner\StorePetRequest;
use App\Models\AllergyCategory;
use App\Models\Appointment;
use App\Models\Breed;
use App\Models\Icon;
use App\Models\MedicationType;
use App\Models\Notification;
use App\Models\Pet;
use App\Models\PetAllergy;
use App\Models\PetType;
use App\Models\PetWeight;
use App\Services\PetService;
use App\Utilities\FieldAttachmentUploadUtility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
	private $fieldAttachmentUploadUtility;
	private $petService;

	public function __construct(FieldAttachmentUploadUtility $fieldAttachmentUploadUtility, PetService $petService)
	{
		$this->fieldAttachmentUploadUtility = $fieldAttachmentUploadUtility;
		$this->petService = $petService;
	}

	public function index()
	{
		$pets = auth()->user()->profile->pet;

		return view('app.pet-owner.pets.index', compact('pets'));
	}

	public function create()
	{
		$petTypes = PetType::all();
		$breeds = Breed::all();
		$allergyCategory = AllergyCategory::orderBy('name')->get();

		$allergyTemplate = [
			[
				'name' => 'chicken',
				'description' => 'Allergy with chicken base product',
				'icon' => 'fa-light fa-drumstick-bite'
			],
			[
				'name' => 'cow',
				'description' => 'Allergy with cow base product',
				'icon' => 'fa-light fa-cow'
			],
			[
				'name' => 'insect',
				'description' => 'Allergy with insect base product',
				'icon' => 'fa-light fa-bug'
			],
			[
				'name' => 'seed',
				'description' => 'Allergy with seed base product',
				'icon' => 'fa-light fa-acorn'
			],
			[
				'name' => 'soap',
				'description' => 'Allergy with soap',
				'icon' => 'fa-light fa-pump-soap'
			],
			[
				'name' => 'wheat',
				'description' => 'Allergy with wheat base product',
				'icon' => 'fa-light fa-wheat'
			],
			[
				'name' => 'mushroom',
				'description' => 'Allergy with mushroom base product',
				'icon' => 'fa-light fa-mushroom'
			],
			[
				'name' => 'Peanut',
				'description' => 'Allergy with peanut base product',
				'icon' => 'fa-light fa-peanut'
			]
		];

		return view('app.pet-owner.pets.create', compact('petTypes', 'breeds', 'allergyTemplate', 'allergyCategory'));
	}

	public function store(StorePetRequest $request)
	{
		$payload = collect($request->validated());
		$payload['pet_owner_id'] = Auth::user()->profile->id;

		$data = $request->validated();

		$petAllergy = collect($data['pet_allergy_ids']);

		try {
			DB::beginTransaction();

			$pet = Pet::create([
				'pet_owner_id' => Auth::user()->profile->id,
				'name' => $data['name'],
				'breed_id' => $data['breed_id'],
				'birth_date' => $data['birth_date'],
				'gender' => $data['gender']
			]);

			if (isset($data['weight'])) {
				PetWeight::create([
					'pet_id' => $pet->id,
					'weight' => $data['weight'],
					'age' => isset($data['birth_date']) ? Carbon::parse($data['birth_date'])->age : 0,
				]);
			}

			$icon = Icon::all()->pluck('id', 'name');

			if ($petAllergy->isNotEmpty()) {
				$petAllergy->transform(function ($allergy) use ($pet, $icon) {
					$tempAllergy['name'] = $allergy->name;
					$tempAllergy['note'] = $allergy->description;
					$tempAllergy['icon_id'] = $icon[$allergy->icon];
					$tempAllergy['allergy_category_id'] = $allergy->allergy_category_id;

					$tempAllergy['pet_id'] = $pet->id;
					return $tempAllergy;
				});

				PetAllergy::insert($petAllergy->toArray());
			}

			$this->fieldAttachmentUploadUtility
				->setRefTable($pet::class)
				->setRefId($pet->id)
				->setFolder('pet_image')
				->setFieldName('pet_image')
				->uploadFile($request);
		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error-swal', 'Something Went Wrong!');
		}

		DB::commit();

		$petService = new PetService();

		$pet = $petService->transformData($pet);
		session()->put('session_pet', $pet);

		return to_route('pet-owner.index')->with('success-swal', 'Pet Successfully Created');
	}

	public function edit(Request $request, $petId)
	{
		$selectedPet = Pet::where([
			['id', $petId],
			['pet_owner_id', auth()->user()->profile->id]
		])->with([
			'petVaccination.vaccination',
			'petAllergy' => function ($q) {
				$q->with('icon', 'allergyCategory');
			},
			'breed',
			'petWeight' => fn($q) => $q->latest(),
			'medicalRecord',
			'petMedication.medicationType'
		])->firstOrFail();

		$jumpToStep = $request->step;

		$petTypes = PetType::all();
		$breeds = Breed::all();
		$allergyCategories = AllergyCategory::all();
		$icons = Icon::all();
		$medicationTypes = MedicationType::all();

		return view('app.pet-owner.pets.edit', compact(
			'selectedPet',
			'petTypes',
			'breeds',
			'allergyCategories',
			'icons',
			'jumpToStep',
			'medicationTypes'
		));
	}

	public function update(Request $request, Pet $pet)
	{
		$pet->update([
			'pet_owner_id' => Auth::user()->profile->id,
			'name' => $request['name'],
			'breed_id' => $request['breed_id'],
			'birth_date' => $request['birth_date'],
			'gender' => $request['gender'],
			'chip_number' => $request['chip_number']
		]);

		if (isset($request['weight'])) {
			PetWeight::create([
				'pet_id' => $pet->id,
				'weight' => $request['weight'],
				'age' => isset($data['birth_date']) ? Carbon::parse($data['birth_date'])->age : 0,
			]);
		}

		if ($request->file('pet_image')) {
			$this->fieldAttachmentUploadUtility
				->setRefTable($pet::class)
				->setRefId($pet->id)
				->setFolder('pet_image')
				->setFieldName('pet_image')
				->uploadFile($request);
		}

		return to_route('pet-owner.index')->with('success-swal', 'Pet Successfully Updated');
	}

	public function switchPetProfile(Pet $pet)
	{
		$pet = $this->petService->transformData($pet);

		session(['session_pet' => $pet]);

		return back();
	}

	public function destroy(Pet $pet)
	{
		$petOwnerId = auth()->user()->profile->id;

		if ($pet->pet_owner_id !== $petOwnerId) {
			abort(400, "Illegal Action");
		}

		$haveAppointment = Appointment::where('pet_id', $pet->id)->whereNull('finished_at')->whereNull('is_cancelled')->count() > 0;

		if ($haveAppointment) {
			return back()->with('error-swal', 'Pet has an Active Appointment');
		}

		Notification::where('pet_id', $pet->id)->delete();
		$pet->delete();

		return to_route('pet-owner.index')->with('success-swal', 'Pet Successfully Deleted');
	}
}
