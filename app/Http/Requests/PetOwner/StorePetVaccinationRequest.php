<?php

namespace App\Http\Requests\PetOwner;

use Illuminate\Foundation\Http\FormRequest;

class StorePetVaccinationRequest extends FormRequest
{
   public function authorize()
   {
      return true;
   }

   public function rules()
   {
      return [
         'pet_id' => 'required',
         'vaccination_id' => 'required',
         'given_at' => 'required',
         'given_by' => 'required',
      ];
   }
}
