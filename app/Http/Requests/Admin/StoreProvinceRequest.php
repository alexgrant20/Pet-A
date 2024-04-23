<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProvinceRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|unique:provinces,name,NULL,id,deleted_at,NULL',
			'latitude' => 'required|decimal:3,12',
			'longitude' => 'required|decimal:3,12'
		];
	}
}
