<?php

namespace App\Http\Requests\PetOwner;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
         'pet_id' => 'required',
         'service_type_id' => 'required',
         'veterinarian_id' => 'required',
         'appointment_schedule_id' => 'required',
         'appointment_note' => 'required',
         'appointment_date' => 'required|date_format:d-m-Y'
		];
	}
}
