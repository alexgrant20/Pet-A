<?php

namespace App\Http\Requests\PetOwner;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

   public function validated($key = null, $default = null)
   {
      $validatedData = parent::validated();

      $validatedData['pet_allergy_ids'] = json_decode($validatedData['pet_allergy_ids']);

      return $validatedData;
   }

	public function rules()
	{
		return [
			'name' => 'required|string',
			'breed_id' => 'required',
			'birth_date' => 'nullable|date|before:now',
			'weight' => 'nullable|decimal:0,2',
			'gender' => 'nullable|in:m,f',
         'chip_number' => 'nullable|string',
			'pet_image' => 'required|file|image|mimes:png,jpg,jpeg',
         'pet_allergy_ids' => 'required'
		];
	}
}
