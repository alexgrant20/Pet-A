<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
	public function store(RegisterRequest $request)
	{
		DB::beginTransaction();
		try {
			$user = User::create([
				'id' => Str::uuid(),
				'name' => $request->name,
				'phone_number' => $request->phone_number,
				'email' => $request->email,
				'password' => Hash::make($request->password)
			]);

			$user->assignRole('pet-owner');
		} catch (\Exception $e) {
			DB::rollBack();
			return response()->json(['status' => false]);
		}

		DB::commit();

		return response()->json(['status' => true]);
	}
}
