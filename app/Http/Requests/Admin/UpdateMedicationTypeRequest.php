<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicationTypeRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => "required|unique:medication_types,name,{$this->medicationType->id},id,deleted_at,NULL",
		];
	}
}
