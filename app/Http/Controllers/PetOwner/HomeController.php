<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use App\Services\PetService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   private $petService;

   public function __construct(PetService $petService) {
      $this->petService = $petService;
   }

   public function index()
   {
      return view('app.pet-owner.index');
   }
}
