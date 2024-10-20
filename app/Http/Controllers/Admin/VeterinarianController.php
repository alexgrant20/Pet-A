<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVeterinarianRequest;
use App\Http\Requests\Admin\UpdateVeterinarianRequest;
use App\Models\Clinic;
use App\Models\PetType;
use App\Models\Veterinarian;
use App\Models\VeterinarianPetType;
use App\Utilities\FieldAttachmentUploadUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return view('app.admin.veterinarian.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      $petTypes = PetType::all();
      $clinics = Clinic::all();

      return view('app.admin.veterinarian.create', compact('petTypes', 'clinics'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreVeterinarianRequest $request)
   {
      $payload = $request->validated();

      try {
         DB::beginTransaction();

         $veterinarian = Veterinarian::create($payload);
         $doctorPetTypePayload = array_map(fn($data) => ['pet_type_id' => $data, 'veterinarian_id' => $veterinarian->id], $request->doctor_pet_type);
         VeterinarianPetType::insert($doctorPetTypePayload);

         $veterinarian->user()->create([
            'name' => $request->name,
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
      }

      DB::commit();
      return to_route('admin.veterinarian.index')->with('success-toast', 'Veterianarian Sucessfully Created');
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Veterinarian $veterinarian)
   {
      $petTypes = PetType::all();
      $clinics = Clinic::all();

      return view('app.admin.veterinarian.edit',  compact('veterinarian', 'petTypes', 'clinics'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdateVeterinarianRequest $request, Veterinarian $veterinarian)
   {
      $payload = $request->validated();

      try {
         DB::beginTransaction();

         $veterinarian->update($payload);

         $doctorPetTypePayload = array_map(fn($data) => ['pet_type_id' => $data, 'veterinarian_id' => $veterinarian->id], $request->doctor_pet_type);

         VeterinarianPetType::where('veterinarian_id', $veterinarian->id)
            ->whereNotIn('pet_type_id', $request->doctor_pet_type)
            ->delete();

         VeterinarianPetType::upsert($doctorPetTypePayload, ['pet_type_id', 'veterinarian_id']);

         $veterinarian->user()->create([
            'name' => $request->name,
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

         dd($e->getMessage());
         DB::rollBack();
         return to_route('admin.veterinarian.index')->with('error-toast', 'Failed to Update Veterinarian');
      }

      DB::commit();
      return to_route('admin.veterinarian.index')->with('success-toast', 'Veterianarian Sucessfully Updated');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      //
   }
}
