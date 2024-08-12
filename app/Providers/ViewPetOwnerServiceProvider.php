<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Services\PetService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewPetOwnerServiceProvider extends ServiceProvider
{
   /**
    * Bootstrap services.
    */
   public function boot(): void
   {
      View::composer(['layouts.pet-owner.navbar'], function ($view) {
         $pets = Auth::user()->profile->pet;

         $pets->load('attachment');

         $pets->map(function ($pet) {
           $pet->thumbnail_image = $pet->attachment->first()?->path;

           return $pet;
         });

         $view->with('pets', $pets);
      });

      View::composer(['layouts.public.footer'], function ($view) {
         $count = Appointment::count();

         $view->with('totalPetSaved', $count);
      });

      View::composer(['app.pet-owner.*'], function ($view) {
         $pet = session('session_pet');

         $view->with('pet', $pet);
      });
   }
}
