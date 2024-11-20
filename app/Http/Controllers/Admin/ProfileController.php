<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVeterinarianRequest;
use App\Http\Requests\Admin\UpdateVeterinarianRequest;
use App\Models\City;
use App\Models\Clinic;
use App\Models\PetType;
use App\Models\Province;
use App\Models\User;
use App\Models\Veterinarian;
use App\Models\VeterinarianPetType;
use App\Utilities\FieldAttachmentUploadUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ProfileController extends Controller
{
   private $fieldAttachmentUploadUtility;

   public function __construct(FieldAttachmentUploadUtility $fieldAttachmentUploadUtility)
   {
      $this->fieldAttachmentUploadUtility = $fieldAttachmentUploadUtility;
   }

   public function edit(Veterinarian $veterinarian)
   {
      $veterinarian->load('attachment', 'user', 'clinic', 'petType');

      $clinics = Clinic::get();
      $petTypes = PetType::get();
      return view('app.admin.profile.edit',  compact('veterinarian', 'clinics', 'petTypes'));
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
      return back()->with('success-toast', 'Veterianarian Sucessfully Updated');
   }
}
