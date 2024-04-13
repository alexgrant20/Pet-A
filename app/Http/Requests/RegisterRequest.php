<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required|max:25',
			'email' => 'required|email|unique:users,email',
			'phone_number' => 'required|string|max:12',
			'password' => 'required|min:8',
			'password_confirmation' => 'required|same:password|min:8',
		];
	}
}
