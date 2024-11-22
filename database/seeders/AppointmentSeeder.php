<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      Appointment::create([
         'pet_owner_id' => 1,
         'pet_id' => 1,
         'appointment_schedule_id' => 2,
         'clinic_id' => 1,
         'service_type_id' => 1,
         'veterinarian_id' => 1,
         'appointment_note' => 'Anjing saya muntah-muntah',
         'appointment_date' => '2024-11-26',
      ]);

      Appointment::create([
         'pet_owner_id' => 1,
         'pet_id' => 2,
         'appointment_schedule_id' => 82,
         'clinic_id' => 1,
         'service_type_id' => 1,
         'veterinarian_id' => 1,
         'appointment_note' => 'Anjing saya kejang',
         'appointment_date' => '2024-11-28',
      ]);
   }
}
