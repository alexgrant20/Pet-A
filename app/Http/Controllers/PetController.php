<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetOwner\StorePetRequest;
use App\Models\Breed;
use App\Models\FieldAttachmentUpload;
use App\Models\MedicalRecord;
use App\Models\Pet;
use App\Models\PetAllergy;
use App\Models\PetType;
use App\Models\PetVaccination;
use App\Models\Vaccination;
use App\Utilities\FieldAttachmentUploadUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
   private $fieldAttachmentUploadUtility;

   public function __construct(FieldAttachmentUploadUtility $fieldAttachmentUploadUtility)
   {
      $this->fieldAttachmentUploadUtility = $fieldAttachmentUploadUtility;
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

      return view('app.pet-owner.pets.create', compact('petTypes', 'breeds'));
   }

   public function store(StorePetRequest $request)
   {
      $payload = collect($request->validated());
      $payload['pet_owner_id'] = Auth::user()->profile->id;

      $petAllergy = collect(json_decode($request->pet_allergy));
      $petVaccination = collect(json_decode($request->pet_vaccination));
      $petMedicalRecord = collect(json_decode($request->pet_medical));

      try {
         DB::beginTransaction();

         $pet = Pet::create([
            'pet_owner_id' => Auth::user()->profile->id,
            'name' => $payload['name'],
            'chip_number' => $payload['chip_number'],
            'pet_type_id' => $payload['pet_type_id'],
            'breed_id' => $payload['breed_id'],
            'birth_date' => $payload['birth_date'],
            'weight' => $payload['weight'],
            'gender' => $payload['gender']
         ]);

         if($petAllergy->isNotEmpty()) {
            $petAllergy->transform(function ($allergy) use($pet) {
               $tempAllergy['name'] = $allergy[0];
               $tempAllergy['note'] = $allergy[1];
               $tempAllergy['pet_id'] = $pet->id;
               return $tempAllergy;
            });

            PetAllergy::insert($petAllergy->toArray());
         }

         if($petVaccination->isNotEmpty()) {

            $petVaccinationNameList = $petVaccination->pluck(0)->all();
            $petVaccinationDict = Vaccination::whereIn('name', $petVaccinationNameList)->pluck('id', 'name');

            $petVaccination->transform(function ($vaccination) use($pet, $petVaccinationDict) {
               $tempVaccination['given_at'] = $vaccination[2];
               $tempVaccination['given_by'] = $vaccination[1];
               $tempVaccination['pet_id'] = $pet->id;
               $tempVaccination['vaccination_id'] = $petVaccinationDict[$vaccination[0]];
               return $tempVaccination;
            });

            PetVaccination::insert($petVaccination->toArray());
         }

         $this->fieldAttachmentUploadUtility
            ->setRefTable($pet::class)
            ->setRefId($pet->id)
            ->setFolder('pet_image')
            ->setFieldName('pet_image')
            ->uploadFile($request);

      } catch (\Exception $e) {
         dd($e->getMessage());
         DB::rollBack();
         return back()->with('error-swal', 'Something Went Wrong!');
      }

      DB::commit();

      return to_route('pet-owner.index')->with('success-toast', 'Pet Successfully Created');
   }

   public function show($petId)
   {
      $pet = Pet::where([
         ['id', $petId],
         ['pet_owner_id', auth()->user()->profile->id]
      ])->with('petVaccination.vaccination', 'petAllergy', 'breed.petType')->firstOrFail();

      return view('app.pet-owner.pets.show', compact('pet'));
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit($petId)
   {
      $pet = Pet::where([
         ['id', $petId],
         ['pet_owner_id', auth()->user()->profile->id]
      ])->with('petVaccination.vaccination', 'petAllergy', 'breed')->firstOrFail();

      $petTypes = PetType::all();
      $breeds = Breed::all();

      return view('app.pet-owner.pets.edit', compact('pet', 'petTypes', 'breeds'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      //
   }
}
