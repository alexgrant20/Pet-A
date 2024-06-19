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
      $requiredIfVeterinarian = 'required_if:role_id,' . self::ROLE_VETERINARIAN;
		return [
			'name' => 'required',
         'phone_number' => $requiredIfVeterinarian,
			'email' => 'required|email|unique:users,email,' . $user->id . ',id',
         'city_id' => $requiredIfVeterinarian,
			'clinic_name' => $requiredIfVeterinarian,
         'clinic_phone_number' => $requiredIfVeterinarian,
         'clinic_address' => $requiredIfVeterinarian,
			'zip_code' => $requiredIfVeterinarian,
         'length_of_service' => $requiredIfVeterinarian,
			'is_active' => 'required|in:0,1'
 		];
	}

	public function attributes()
	{
		return [
			'name' => 'Nama',
			'phone_number' => 'Nomor Telepon',
			'email' => 'Email',
			'clinic_name' => 'Nama',
			'clinic_phone_number', 'Nomor Telepon',
			'city_id' => 'Kota',
			'clinic_address' => 'Alamat',
			'length_of_service' => 'Lama Bekerja',
			'zip_code' => 'Kode Pos',
			'is_active' => 'Status'
		];
	}

	public function messages()
	{
		return [
			'is_active.in' => 'Status harus berupa Aktif atau Tidak Aktif.',
			'*.required_if' => ':attribute wajib diisi.'
		];
	}
}
