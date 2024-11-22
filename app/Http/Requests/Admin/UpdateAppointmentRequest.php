<?php

namespace App\Http\Requests\Admin;

use App\Interfaces\ServiceTypeInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest implements ServiceTypeInterface
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'weight' => 'required|numeric',
			'weight_unit' => 'required|string|in:g,kg',
			'next_appointment' => 'int|required_if:' . $this->appointment->service_type_id . ',' . self::SERVICE_TYPE_VAKSINASI,
			'next_appointment_unit' => 'in:month,year|required_if:' . $this->appointment->service_type_id .','. self::SERVICE_TYPE_VAKSINASI,
			'vaccination.*' => 'nullable',
			'disesase_name' => 'nullable|string',
			'medicine_name' => 'nullable|string',
         'medicine_dosage' => 'nullable|string',
         'note' => 'nullable|string',
         'summary' => 'nullable|string',
		];
	}
}
