<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
  public function run(): void
  {
    Field::insert([['name' => 'pet_image'], ['name' => 'profile_image']]);
  }
}
