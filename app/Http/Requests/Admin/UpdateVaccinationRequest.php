<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVaccinationRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => "required|unique:vaccinations,name,{$this->vaccination->id},id,deleted_at,NULL",
			'pet_type_id' => 'required',
		];
	}
}
