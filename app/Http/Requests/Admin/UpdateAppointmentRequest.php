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
			'weight' => 'required',
			'weight_unit' => 'required',
			'next_appointment' => 'required_if:' . $this->appointment->service_type_id . ',' . self::SERVICE_TYPE_VAKSINASI,
			'next_appointment_unit' => 'required_if:' . $this->appointment->service_type_id .','. self::SERVICE_TYPE_VAKSINASI,
			'vaccination.*' => 'nullable',
			'disesase_name' => 'nullable',
			'medicine_name' => 'nullable',
         'medicine_dosage' => 'nullable',
         'note' => 'nullable',
         'appointment_note' => 'nullable',
		];
	}
}
