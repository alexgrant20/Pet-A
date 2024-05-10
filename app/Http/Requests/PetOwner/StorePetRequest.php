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
			'age' => 'nullable|numeric',
			'weight' => 'nullable|decimal:0,2',
			'gender' => 'nullable|in:m,f',
			'pet_image' => 'required|file|image|mimes:png,jpg,jpeg'
		];
	}
}
