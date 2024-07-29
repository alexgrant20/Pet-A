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
      $pets = Auth::user()->profile->pet;

      if($pets->count() == 0) {
         session()->delete('session_pet');
         return null;
      }

      $petService = new PetService();
      $pet = session('session_pet');

      $pet = $pet ? $pets->where('id', $pet->id)->first() : $pets->first();

      $pet = $petService->transformData($pet);
      session()->put('session_pet', $pet);
      session()->save();
   }
}
