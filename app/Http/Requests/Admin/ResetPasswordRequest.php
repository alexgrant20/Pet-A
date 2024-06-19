<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'password' => 'required|confirmed|string|min:8'
 		];
	}
	public function attributes()
	{
		return [
			'password' => 'Kata Sandi'
		];
	}
}
