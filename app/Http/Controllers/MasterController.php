<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\City;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
   public function getBreed(Request $request, int $petTypeId)
   {
      if (!$request->ajax()) return;

      $result = [
         'status' => 404,
         'message' => 'Data tidak ditemukan',
         'result' => [],
      ];

      $limit = $request->limit ?? 10;
      $page = $request->page ?? 1;

      $breeds = Breed::where('pet_type_id', $petTypeId)
         ->where(DB::raw('LOWER(name)'), 'LIKE', '%' . strtolower($request->q) . '%') // Normalize to lowercase
         ->skip($limit * ($page - 1))
         ->limit($limit)
         ->get()
         ->map(fn($breed) => ['id' => $breed->id, 'text' => $breed->name]);


      return [
         'status' => 200,
         'message' => 'Sukses',
         'result' => $breeds,
      ];
   }

   public function getCity(Request $request)
   {
      if (!$request->ajax()) return;

      return City::where('province_id', $request->province_id)
         ->get()
         ->map(fn($city) => ['id' => $city->id, 'text' => $city->name]);
   }

   public function getVaccination(Request $request, int $petTypeId)
   {
      if (!$request->ajax()) return;

      return Vaccination::where('pet_type_id', $petTypeId)
         ->get()
         ->map(fn($vaccination) => ['id' => $vaccination->id, 'text' => $vaccination->name]);
   }
}
