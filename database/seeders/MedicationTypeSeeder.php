<?php

namespace Database\Seeders;

use App\Models\MedicationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicationType::insert([
            ['name' => 'Anthelmintic'],
            ['name' => 'flea medicine'],
        ]);
    }
}
