<?php

namespace App\Http\Requests\Admin;

use App\Interfaces\RoleInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest implements RoleInterface
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$user = request('user');
		return [
			'name' => 'required',
         'phone_number' => 'nullable',
			'email' => 'required|email|unique:users,email,' . $user->id . ',id',
			'is_active' => 'required|in:0,1'
 		];
	}

	public function attributes()
	{
		return [
			'name' => 'Name',
			'phone_number' => 'Phone Number',
			'email' => 'Email',
			'is_active' => 'Status'
		];
	}

	public function messages()
	{
		return [
			'is_active.in' => 'Status should be in Active or Inactive.',
			'*.required_if' => ':attribute is required.'
		];
	}
}
