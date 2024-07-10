<?php

namespace App\Http\Requests\PetOwner;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|string',
			'pet_type_id' => 'required',
			'breed_id' => 'required',
			'birth_date' => 'nullable|date|before:now',
			'weight' => 'nullable|decimal:0,2',
			'gender' => 'nullable|in:m,f',
         'chip_number' => 'nullable|string',
			'pet_image' => 'required|file|image|mimes:png,jpg,jpeg'
		];
	}
}
