<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\PetOwner;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
	public function create()
	{
		return view('app.auth.register');
	}

	public function store(RegisterRequest $request)
	{
		DB::beginTransaction();
		try {
			$petOwner = PetOwner::create();

			$user = new User ([
            'phone_number' => $request->phone_number,
            'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password)
			]);

			$user->profile()->associate($petOwner)->save();
			$user->assignRole('pet-owner');
		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error-swal', 'Something went wrong, try again later');
		}

		DB::commit();
		Auth::login($user);

		return to_route('pet-owner.index');
	}
}
