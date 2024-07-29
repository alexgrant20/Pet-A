<?php

namespace App\Services;

use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PetService
{

   public function transformData(Pet $pet)
   {
      $pet->load([
         'appointment' => function ($q) {
            $q->orderBy('created_at');
            $q->with('appointmentSchedule', 'serviceType');
         },
         'breed.petType',
         'attachment',
         'petAllergy' => fn($q) => $q->latest(),
         'petAllergy.icon',
         'medicalRecord' => fn($q) => $q->latest(),
         'petVaccination.vaccination' => fn($q) => $q->latest(),
         'petWeight'
      ]);

      [$futureAppointment, $historyAppointment] =  $pet->appointment->partition(function ($appointment) {
         return $appointment->appointment_date > now();
      });

      $pet->gender = filled($pet->gender) == 'm' ? 'Jantan' : 'Betina';
      $pet->age = Carbon::parse($pet->birth_date)->age;
      $pet->thumbnail_image = $pet->attachment->first()?->path;
      $pet->weight = $pet->petWeight->first()?->weight . ' Kg';
      $pet->future_appointment = $futureAppointment->take(3);
      $pet->history_appointment = $historyAppointment->take(3);

      $pet->petWeight = $pet->petWeight->take(6);

      return $pet;
   }
}
