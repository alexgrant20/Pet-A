<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetTypeRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => "required|unique:pet_types,name,{$this->petType->id},id,deleted_at,NULL",
		];
	}
}
