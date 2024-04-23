<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProvinceRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => "required|unique:provinces,name,{$this->province->id},id,deleted_at,NULL",
			'latitude' => 'required|decimal:3,12',
			'longitude' => 'required|decimal:3,12'
		];
	}
}
