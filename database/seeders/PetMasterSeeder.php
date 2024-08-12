<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\PetType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetMasterSeeder extends Seeder
{
  public function run(): void
  {
    PetType::insert([
      ['name' => 'dog', 'icon_id' => 1],
      ['name' => 'cat', 'icon_id' => 2],
      ['name' => 'bird', 'icon_id' => 3]
   ]);

    $file_path = public_path('sql/breeds.sql');

    DB::unprepared(
      file_get_contents($file_path)
    );
  }
}
