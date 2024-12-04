<?php

namespace App\Http\Middleware;

use App\Services\PetService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
      $validationResult = $this->checkPetSession();

      if(!$validationResult) return to_route('pet-owner.pet.create');

      return $next($request);
   }

   private function checkPetSession()
   {
      $pets = Auth::user()->profile->pet;

      if($pets->count() == 0) {
         if(session()->has('session_pet')) {
            session()->forget('session_pet');
         }

         if(Route::current()->action['as'] == 'pet-owner.index') {
            return false;
         };
         return true;
      }

      $petService = new PetService();
      $pet = session('session_pet');

      $pet = $pet ? $pets->where('id', $pet->id)->first() : $pets->first();

      if($pet == null) {
         $pet = $pets->first();
      }

      $pet = $petService->transformData($pet);
      session()->put('session_pet', $pet);

      return true;
   }
}
