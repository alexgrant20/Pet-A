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
      ['name' => 'anjing', 'icon_id' => 1],
      ['name' => 'kucing', 'icon_id' => 2],
      ['name' => 'burung', 'icon_id' => 3],
      ['name' => 'ikan', 'icon_id' => 4],
   ]);

    $file_path = public_path('sql/breeds.sql');

    DB::unprepared(
      file_get_contents($file_path)
    );
  }
}
