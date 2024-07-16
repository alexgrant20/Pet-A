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
         'appointment.serviceType' => fn($q) => $q->latest(),
         'breed.petType',
         'attachment',
         'petAllergy' => fn($q) => $q->latest(),
         'medicalRecord' => fn($q) => $q->latest(),
         'petVaccination.vaccination' => fn($q) => $q->latest(),
         'petWeight' => fn($q) => $q->latest()
      ]);

      $pet->gender = $pet->gender == 'm' ? 'Jantan' : 'Betina';
      $pet->age = Carbon::parse($pet->birth_date)->age;
      $pet->thumbnail_image = $pet->attachment->first()?->path;
      $pet->weight = $pet->weight?->first() . ' Kg';

      return $pet;
   }
}
