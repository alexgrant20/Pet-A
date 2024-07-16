<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
   public function run(): void
   {
      Pet::create([
         'pet_owner_id' => 1,
         'breed_id' => 187,
         'name' => 'Dash',
         'birth_date' => '2022-08-15',
         'gender' => 'm'
      ]);
   }
}
