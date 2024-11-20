<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVeterinarianRequest;
use App\Http\Requests\Admin\UpdateVeterinarianRequest;
use App\Models\City;
use App\Models\Clinic;
use App\Models\PetType;
use App\Models\Province;
use App\Models\Veterinarian;
use App\Models\VeterinarianPetType;
use App\Utilities\FieldAttachmentUploadUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class VeterinarianController extends Controller
{
   private $fieldAttachmentUploadUtility;

   public function __construct(FieldAttachmentUploadUtility $fieldAttachmentUploadUtility)
   {
      $this->fieldAttachmentUploadUtility = $fieldAttachmentUploadUtility;
   }

   public function getList()
   {
      $veterinarians = Veterinarian::with('attachment', 'user', 'petType', 'clinic')->get();

      return DataTables::of($veterinarians)
         ->addIndexColumn()
         ->addColumn('photo', function ($veterinarian) {
            return view('app.admin.veterinarian.components.__profile_image', compact('veterinarian'));
         })
         ->addColumn('doctor_speciality', function ($veterinarian) {
            return view('app.admin.veterinarian.components.__doctor_speciality', compact('veterinarian'));
         })
         ->addColumn('action', function ($veterinarian) {
            return view('app.admin.veterinarian.components.__action', compact('veterinarian'));
         })
         ->make();
   }

   public function index()
   {
      $veterinarians = Veterinarian::with(['user', 'attachment'])->orderBy('id')->paginate(8);

      return view('app.admin.veterinarian.index', compact('veterinarians'));
   }

   public function create()
   {
      $petTypes = PetType::get();
      $clinics = Clinic::get();

      return view('app.admin.veterinarian.create', compact('petTypes', 'clinics'));
   }

   public function store(StoreVeterinarianRequest $request)
   {
      $payload = $request->validated();

      try {
         DB::beginTransaction();

         $veterinarian = Veterinarian::create([
            'clinic_id' => $request->clinic_id,
            'length_of_service' => $request->length_of_service
         ]);

         $veterinarianPetTypePayload = array_map(fn($data) => ['pet_type_id' => $data, 'veterinarian_id' => $veterinarian->id], $request->veterinarian_pet_type);
         VeterinarianPetType::insert($veterinarianPetTypePayload);

         $veterinarian->user()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender
         ]);

         $this->fieldAttachmentUploadUtility
            ->setRefTable($veterinarian::class)
            ->setRefId($veterinarian->id)
            ->setFolder('profile_image')
            ->setFieldName('profile_image')
            ->uploadFile($request);
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error-toast', 'Failed to create Veterinarian Account');
      }

      DB::commit();
      return to_route('admin.veterinarian.index')->with('success-toast', 'Veterianarian Sucessfully Created');
   }

   public function edit(Veterinarian $veterinarian)
   {
      $veterinarian->load('attachment', 'user', 'clinic', 'petType');

      $clinics = Clinic::get();
      $petTypes = PetType::get();
      return view('app.admin.veterinarian.edit',  compact('veterinarian', 'clinics', 'petTypes'));
   }

   public function update(UpdateVeterinarianRequest $request, Veterinarian $veterinarian)
   {
      try {
         DB::beginTransaction();

         $veterinarian->update([
            'clinic_id' => $request->clinic_id,
            'length_of_service' => $request->length_of_service
         ]);

         $veterinarianPetTypePayload = array_map(fn($data) => ['pet_type_id' => $data, 'veterinarian_id' => $veterinarian->id], $request->veterinarian_pet_type);

         VeterinarianPetType::where('veterinarian_id', $veterinarian->id)
            ->whereNotIn('pet_type_id', $request->veterinarian_pet_type)
            ->delete();

         VeterinarianPetType::upsert($veterinarianPetTypePayload, ['pet_type_id', 'veterinarian_id']);

         $veterinarian->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender
         ]);

         if ($request->profile_image) {
            $this->fieldAttachmentUploadUtility
               ->setRefTable($veterinarian::class)
               ->setRefId($veterinarian->id)
               ->setFolder('profile_image')
               ->setFieldName('profile_image')
               ->uploadFile($request);
         }
      } catch (\Exception $e) {
         DB::rollBack();
         return back()->with('error-toast', 'Failed to Update Veterinarian');
      }

      DB::commit();
      return to_route('admin.veterinarian.index')->with('success-toast', 'Veterianarian Sucessfully Updated');
   }

   public function destroy(string $id)
   {
      //
   }
}
