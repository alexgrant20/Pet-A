<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetOwner\StorePetMedicationRequest;
use App\Models\MedicationType;
use App\Models\Notification;
use App\Models\PetMedication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetMedicationController extends Controller
{
   public function store(StorePetMedicationRequest $request)
   {
      $medicationType = MedicationType::findOrFail($request->medication_type_id);

      $date = new Carbon();

      if ($date->lte($request->given_at)) {
         Notification::create([
            'user_id' => Auth::id(),
            'pet_id' => $request->pet_id,
            'title' => "Medication $medicationType->name",
            'date_start' => $request->given_at
         ]);
      }

      $petMedication = PetMedication::create([
         'medication_type_id' => $request->medication_type_id,
         'medicine_name' => $request->medicine_name,
         'given_at' => $request->given_at,
         'pet_id' => $request->pet_id
      ]);

      return response()->json([
         'id' => $petMedication->id,
         'medication_type' => $medicationType->name,
         'given_at' => $request->given_at,
         'medication_name' => $request->medicine_name
      ]);
   }

   public function destroy(PetMedication $petMedication)
   {
      $petMedication->delete();

      return response()->json();
   }
}
