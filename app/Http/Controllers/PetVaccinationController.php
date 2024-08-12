<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\PetVaccination;
use App\Models\Vaccination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetVaccinationController extends Controller
{
   public function store(Request $request)
   {
      $vaccination = Vaccination::findOrFail($request->vaccination_id);

      $date = new Carbon();

      if($request->given_at > $date) {
         Notification::create([
            'user_id' => Auth::id(),
            'pet_id' => $request->pet_id,
            'title' => "vaccination $vaccination->name",
            'date_start' => $request->given_at
         ]);
      }

      $petVaccination = PetVaccination::create([
         'vaccination_id' => $request->vaccination_id,
         'given_at' => $request->given_at,
         'given_by' => $request->given_by,
         'pet_id' => $request->pet_id
      ]);

      return response()->json([
         'id' => $petVaccination->id,
         'vaccination' => $vaccination->name,
         'given_at' => $request->given_at,
         'given_by' => $request->given_by
      ]);
   }

   public function destroy(PetVaccination $petVaccination)
   {
      $petVaccination->delete();

      return response()->json();
   }
}
