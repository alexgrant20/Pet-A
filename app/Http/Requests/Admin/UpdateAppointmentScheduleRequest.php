<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentScheduleRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'day' => 'required|in:1,2,3,4,5,6,7',
			'appointment_schedule.id.*' => 'required',
			'appointment_schedule.start_time.*' => 'required'
		];
	}
}
