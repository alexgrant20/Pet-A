<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreVeterinarianRequest extends FormRequest
{
   public function authorize()
   {
      return true;
   }

   public function rules()
   {
      return [
         'name' => 'required',
         'phone_number' => 'required',
         'birth_date' => 'required|date',
         'gender' => 'required|in:m,f',
         'length_of_service' => 'required|integer|min:0|max:99',
         'address' => 'required|string',
         'profile_image' => 'required|image|mimes:png,jpg,jpeg',
         'doctor_pet_type' => 'required|array',
         'clinic_id' => 'required'
      ];
   }
}
