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
    PetType::insert([['name' => 'anjing'], ['name' => 'kucing']]);

    $file_path = asset('sql/breeds.sql');

    DB::unprepared(
      file_get_contents($file_path)
    );
  }
}
