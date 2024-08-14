<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeterinarianSeeder extends Seeder
{
   public function run(): void
   {
      DB::table('veterinarians')->insert([
         ['clinic_id' => 1, 'length_of_service' => 5],
         ['clinic_id' => 2, 'length_of_service' => 10],
         ['clinic_id' => 3, 'length_of_service' => 3],
         ['clinic_id' => 4, 'length_of_service' => 7],
         ['clinic_id' => 5, 'length_of_service' => 8],
         ['clinic_id' => 6, 'length_of_service' => 12],
         ['clinic_id' => 7, 'length_of_service' => 6],
         ['clinic_id' => 8, 'length_of_service' => 4],
         ['clinic_id' => 9, 'length_of_service' => 9],
         ['clinic_id' => 10, 'length_of_service' => 11],
         ['clinic_id' => 11, 'length_of_service' => 2],
         ['clinic_id' => 12, 'length_of_service' => 13],
         ['clinic_id' => 13, 'length_of_service' => 5],
         ['clinic_id' => 14, 'length_of_service' => 7],
         ['clinic_id' => 15, 'length_of_service' => 3],
         ['clinic_id' => 16, 'length_of_service' => 10],
      ]);
   }
}
