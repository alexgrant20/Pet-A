<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use Illuminate\Http\Request;

class MasterController extends Controller
{
	public function getBreed(Request $request)
	{
		if (!$request->ajax()) return;

		return Breed::where('pet_type_id', $request->pet_type_id)
			->get()
			->map(fn ($breed) => ['id' => $breed->id, 'text' => $breed->name]);
	}
}
