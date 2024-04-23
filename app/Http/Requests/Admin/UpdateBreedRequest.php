<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBreedRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => "required|unique:breeds,name,{$this->breed->id},id,deleted_at,NULL",
			'pet_type_id' => 'required',
		];
	}
}
