<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\PetWeight;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
   public function run(): void
   {
      Pet::insert([
         ['pet_owner_id' => 1, 'breed_id' => 1, 'name' => 'Nahuhu', 'birth_date' => '2021-05-12', 'gender' => 'm'],
         ['pet_owner_id' => 1, 'breed_id' => 3, 'name' => 'Labubu', 'birth_date' => '2020-06-12', 'gender' => 'f'],
         ['pet_owner_id' => 1, 'breed_id' => 6, 'name' => 'Dahlia', 'birth_date' => '2021-01-19', 'gender' => 'f'],
      ]);

      PetWeight::insert([
         ['pet_id' => 1, 'weight' => 2, 'age' => 1, 'unit' => 'kg', 'created_at' => '2022-05-20'],
         ['pet_id' => 1, 'weight' => 4, 'age' => 1, 'unit' => 'kg', 'created_at' => '2022-06-20'],
         ['pet_id' => 1, 'weight' => 6, 'age' => 2, 'unit' => 'kg', 'created_at' => '2022-07-20'],
         ['pet_id' => 1, 'weight' => 8, 'age' => 2, 'unit' => 'kg', 'created_at' => '2022-08-20'],
         ['pet_id' => 2, 'weight' => 8, 'age' => 1, 'unit' => 'kg', 'created_at' => '2022-09-20'],
         ['pet_id' => 2, 'weight' => 10, 'age' => 2, 'unit' => 'kg', 'created_at' => '2022-10-20'],
         ['pet_id' => 3, 'weight' => 11, 'age' => 1, 'unit' => 'kg', 'created_at' => '2022-11-20'],
         ['pet_id' => 3, 'weight' => 8, 'age' => 2, 'unit' => 'kg', 'created_at' => '2022-12-20'],
      ]);
   }
}
