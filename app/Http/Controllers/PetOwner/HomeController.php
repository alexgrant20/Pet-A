<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   public function index()
   {
      return view('app.pet-owner.index');
   }
}
