<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\City;
use App\Models\Vaccination;
use Illuminate\Http\Request;

class MasterController extends Controller
{
   public function getBreed(Request $request, int $petTypeId)
   {
      if (!$request->ajax()) return;

      return Breed::where('pet_type_id', $petTypeId)
         ->get()
         ->map(fn ($breed) => ['id' => $breed->id, 'text' => $breed->name]);
   }

   public function getCity(Request $request)
   {
      if (!$request->ajax()) return;

      return City::where('province_id', $request->province_id)
         ->get()
         ->map(fn ($city) => ['id' => $city->id, 'text' => $city->name]);
   }

   public function getVaccination(Request $request, int $petTypeId)
   {
      if (!$request->ajax()) return;

      return Vaccination::where('pet_type_id', $petTypeId)
         ->get()
         ->map(fn ($vaccination) => ['id' => $vaccination->id, 'text' => $vaccination->name]);
   }
}
