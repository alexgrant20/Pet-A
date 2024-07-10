<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicePriceRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'service_type_id' => 'required|exists:service_types,id',
			'price' => 'required|int|min:0'
		];
	}
}
