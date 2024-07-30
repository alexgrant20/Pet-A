<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|string',
			'city_id' => 'required|exists:cities,id',
         'phone_number' => 'required',
         'zip_code' => 'required',
         'address' => 'required',
         'clinic_image' => 'required|image|mimes:png,jpg,jpeg',
		];
	}
}
