<?php

namespace Database\Seeders;

use App\Models\AppointmentSchedule;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentScheduleSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      $schedules = [];

      while (count($schedules) < 200) {
         $veterinarian_id = rand(1, 16);
         $hour = rand(8, 20);
         $minute = rand(0, 1) * 30;
         $start_time = sprintf('%02d:%02d', $hour, $minute);
         $day = rand(1, 7);

         $exists = false;
         foreach ($schedules as $schedule) {
            if (
               $schedule['veterinarian_id'] == $veterinarian_id &&
               $schedule['day'] == $day &&
               $schedule['start_time'] == $start_time
            ) {
               $exists = true;
               break;
            }
         }

         if (!$exists) {
            $schedules[] = [
               'veterinarian_id' => $veterinarian_id,
               'start_time' => $start_time,
               'day' => $day,
            ];
         }
      }

      AppointmentSchedule::insert($schedules);
   }
}
