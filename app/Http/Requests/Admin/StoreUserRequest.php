<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required',
         'phone_number' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|confirmed|string|min:8',
         'clinic_name' => 'required|string',
			'clinic_phone_number' => 'required|string',
			'city_id' => 'nullable',
			'zip_code' => 'required',
         'clinic_address' => 'required',
         'length_of_service' => 'required|int'
 		];
	}
	public function attributes()
	{
		return [
			'name' => 'Nama',
			'phone_number' => 'Nomor Telepon',
			'email' => 'Email',
			'password' => 'Kata Sandi',
			'clinic_name' => 'Nama',
			'clinic_phone_number', 'Nomor Telepon',
			'city_id' => 'Kota',
			'zip_code' => 'Kode Pos',
			'clinic_address' => 'Alamat',
			'length_of_service' => 'Lama Bekerja',
		];
	}
}
