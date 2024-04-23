<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|unique:cities,name,NULL,id,deleted_at,NULL',
			'province_id' => 'required',
			'latitude' => 'required|decimal:3,12',
			'longitude' => 'required|decimal:3,12',
		];
	}
}
