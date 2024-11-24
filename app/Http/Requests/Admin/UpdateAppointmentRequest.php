<?php

namespace App\Http\Requests\Admin;

use App\Interfaces\ServiceTypeInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class UpdateAppointmentRequest extends FormRequest implements ServiceTypeInterface
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$rules = [
			'weight' => 'required|numeric',
			'weight_unit' => 'required|string|in:g,kg',
			'vaccination*' => 'nullable|array',
			'disesase_name' => 'nullable|string',
			'medicine_name' => 'nullable|string',
			'medicine_dosage' => 'nullable|string',
			'note' => 'nullable|string',
			'summary' => 'nullable|string',
		];

		if($this->appointment->service_type_id == self::SERVICE_TYPE_VAKSINASI) {
			$rules['next_vaccination'] = 'required|int';
			$rules['next_vaccination_unit'] = 'required|in:month,year';
		}

		return $rules;
	}
}
