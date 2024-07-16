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
      ]);
   }
}
