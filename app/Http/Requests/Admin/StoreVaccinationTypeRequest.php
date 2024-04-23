<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaccinationTypeRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|unique:vaccination_types,name,NULL,id,deleted_at,NULL',
			'pet_type_id' => 'required',
		];
	}
}
