<?php

namespace App\Http\Requests\PetOwner;

use Illuminate\Foundation\Http\FormRequest;

class StorePetAllergyRequest extends FormRequest
{
   public function authorize()
   {
      return true;
   }

   public function rules()
   {
      return [
         'pet_id' => 'required',
         'icon_id' => 'required',
         'allergy_category_id' => 'required',
         'name' => 'required',
         'note' => 'nullable|string',
      ];
   }
}
