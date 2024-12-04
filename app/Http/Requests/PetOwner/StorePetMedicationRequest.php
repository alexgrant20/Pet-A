<?php

namespace App\Http\Requests\PetOwner;

use Illuminate\Foundation\Http\FormRequest;

class StorePetMedicationRequest extends FormRequest
{
   public function authorize()
   {
      return true;
   }

   public function rules()
   {
      return [
         'medication_type_id' => 'required',
         'given_at' => 'required',
         'pet_id' => 'required',
         'medicine_name' => 'required'
      ];
   }
}
