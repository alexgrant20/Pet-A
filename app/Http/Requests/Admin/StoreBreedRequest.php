<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBreedRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|unique:breeds,name,NULL,id,deleted_at,NULL',
			'pet_type_id' => 'required',
		];
	}
}
