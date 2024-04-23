<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use Illuminate\Http\Request;

class MasterController extends Controller
{
	public function cek(Request $request)
	{
		if(!$request->ajax()) return;

		$breeds = Breed::where('pet_type_id', $request->pet_type_id)->pluck('name', 'id');

		return $breeds;
	}
}