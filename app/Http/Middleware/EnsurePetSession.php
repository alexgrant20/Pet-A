<?php

namespace App\Http\Middleware;

use App\Services\PetService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePetSession
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next): Response
   {
      $this->checkPetSession();

      return $next($request);
   }

   private function checkPetSession()
   {
      $pet = session('session_pet');

      $petService = new PetService();
      $pets = Auth::user()->profile->pet;

      if($pets->count() == 0) {
         return null;
      }

      $pet = $petService->transformData($pets->first());
      session()->put('session_pet', $pet);
      session()->save();
   }
}
