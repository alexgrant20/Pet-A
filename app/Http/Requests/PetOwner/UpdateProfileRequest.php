<?php

namespace App\Http\Requests\PetOwner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|string',
			'phone_number' => 'nullable|regex:/^\+?\d{3,}$/',
			'address' => 'nullable',
			'province_id' => 'nullable',
			'city_id' => 'nullable',
			'profile_image' => 'nullable|file|mimes:png,jpg,jpeg',
		];
	}
}
