<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
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
         $count = Appointment::whereNotNull('finished_at')->count();

         $view->with('totalPetSaved', $count);
      });

      View::composer(['app.pet-owner.*'], function ($view) {
         $pet = session('session_pet');

         $view->with('pet', $pet);
      });

      View::composer(['layouts.master.sidebar'], function ($view) {
         $adminId = User::withoutRole('pet-owner')->pluck('id');

         $newMessageCount =  Message::whereNotIn('user_id', $adminId->toArray())
         ->select('session_id')
         ->where('is_read', 0)
         ->groupBy('session_id')
         ->get()
         ->count();

         $view->with('newMessageCount', $newMessageCount);
      });

      View::composer(['layouts.master.navbar'], function ($view) {
         $newNotificationCount = Notification::where('user_id', Auth::id())
         ->where('is_seen', 0)
         ->count();

         $view->with('newNotificationCount', $newNotificationCount);
      });

      View::composer(['layouts.master.navbar'], function ($view) {
         $notifications = Notification::where('user_id', Auth::id())
         ->get();

         $view->with('notifications', $notifications);
      });
   }
}
