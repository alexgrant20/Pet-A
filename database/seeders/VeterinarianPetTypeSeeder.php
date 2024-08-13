<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeterinarianPetTypeSeeder extends Seeder
{
   public function run(): void
   {
      DB::table('veterinarian_pet_types')->insert([
         ['veterinarian_id' => 1, 'pet_type_id' => 1],
         ['veterinarian_id' => 1, 'pet_type_id' => 2],
         ['veterinarian_id' => 1, 'pet_type_id' => 3],
         ['veterinarian_id' => 2, 'pet_type_id' => 1],
         ['veterinarian_id' => 2, 'pet_type_id' => 3],
         ['veterinarian_id' => 3, 'pet_type_id' => 2],
         ['veterinarian_id' => 3, 'pet_type_id' => 1],
         ['veterinarian_id' => 4, 'pet_type_id' => 3],
         ['veterinarian_id' => 4, 'pet_type_id' => 2],
         ['veterinarian_id' => 5, 'pet_type_id' => 1],
         ['veterinarian_id' => 5, 'pet_type_id' => 3],
         ['veterinarian_id' => 6, 'pet_type_id' => 2],
         ['veterinarian_id' => 6, 'pet_type_id' => 1],
         ['veterinarian_id' => 7, 'pet_type_id' => 3],
         ['veterinarian_id' => 7, 'pet_type_id' => 2],
         ['veterinarian_id' => 8, 'pet_type_id' => 1],
         ['veterinarian_id' => 8, 'pet_type_id' => 3],
         ['veterinarian_id' => 9, 'pet_type_id' => 2],
         ['veterinarian_id' => 10, 'pet_type_id' => 1],
         ['veterinarian_id' => 10, 'pet_type_id' => 3],
         ['veterinarian_id' => 11, 'pet_type_id' => 2],
         ['veterinarian_id' => 11, 'pet_type_id' => 1],
         ['veterinarian_id' => 12, 'pet_type_id' => 3],
         ['veterinarian_id' => 12, 'pet_type_id' => 2],
         ['veterinarian_id' => 13, 'pet_type_id' => 1],
         ['veterinarian_id' => 13, 'pet_type_id' => 3],
         ['veterinarian_id' => 14, 'pet_type_id' => 2],
         ['veterinarian_id' => 14, 'pet_type_id' => 1],
         ['veterinarian_id' => 15, 'pet_type_id' => 3],
         ['veterinarian_id' => 15, 'pet_type_id' => 2],
         ['veterinarian_id' => 16, 'pet_type_id' => 1],
         ['veterinarian_id' => 16, 'pet_type_id' => 2],
         ['veterinarian_id' => 16, 'pet_type_id' => 3],
      ]);
   }
}
