<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetOwner\StorePetAllergyRequest;
use App\Models\AllergyCategory;
use App\Models\Icon;
use App\Models\PetAllergy;

class PetAllergyController extends Controller
{
   public function store(StorePetAllergyRequest $request)
   {
      $icon = Icon::findOrFail($request->icon_id);
      $allergyCategory = AllergyCategory::findOrFail($request->allergy_category_id);

      $petAllergy = PetAllergy::create([
         'name' => $request->name,
         'note' => $request->note,
         'icon_id' => $request->icon_id,
         'allergy_category_id' => $request->allergy_category_id,
         'pet_id' => $request->pet_id
      ]);

      return response()->json([
         'id' => $petAllergy->id,
         'name' => $request->name,
         'note' => $request->note,
         'icon' => $icon->name,
         'allergy_category' => $allergyCategory->name
      ]);
   }

   public function destroy(PetAllergy $petAllergy)
   {
      $petAllergy->delete();

      return response()->json();
   }
}
