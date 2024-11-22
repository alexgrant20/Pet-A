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
         ['name' => 'fa-solid fa-dog'],
         ['name' => 'fa-solid fa-cat'],
         ['name' => 'fa-solid fa-dove'],
         ['name' => 'fa-solid fa-fish'],
         ['name' => 'fa-light fa-drumstick-bite'],
         ['name' => 'fa-light fa-cow'],
         ['name' => 'fa-light fa-bug'],
         ['name' => 'fa-light fa-acorn'],
         ['name' => 'fa-light fa-pump-soap'],
         ['name' => 'fa-light fa-wheat'],
         ['name' => 'fa-light fa-mushroom'],
         ['name' => 'fa-light fa-peanut'],
      ]);
   }
}
