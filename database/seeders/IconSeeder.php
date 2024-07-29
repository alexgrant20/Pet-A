<?php

namespace Database\Seeders;

use App\Models\Icon;
use App\Models\Pet;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
   public function run(): void
   {
      Icon::insert([
         ['id' => 1, 'name' => 'fa-solid fa-dog'],
         ['id' => 2, 'name' => 'fa-solid fa-cat'],
         ['id' => 3, 'name' => 'fa-solid fa-dove'],
         ['id' => 4, 'name' => 'fa-solid fa-fish'],
         ['id' => 5, 'name' => 'fa-light fa-drumstick-bite'],
         ['id' => 6, 'name' => 'fa-light fa-cow'],
         ['id' => 7, 'name' => 'fa-light fa-bug'],
         ['id' => 8, 'name' => 'fa-light fa-acorn'],
         ['id' => 9, 'name' => 'fa-light fa-pump-soap'],
         ['id' => 10, 'name' => 'fa-light fa-wheat'],
         ['id' => 11, 'name' => 'fa-light fa-mushroom'],
         ['id' => 12, 'name' => 'fa-light fa-peanut'],
      ]);
   }
}
