<?php

namespace Database\Seeders;

use App\Models\Vaccination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vaccination::insert([
            [
                'pet_type_id' => 1,
                'name' => 'Distemper',
            ],
            [
                'pet_type_id' => 1,
                'name' => 'Hepatitis CAV 2'
            ],
            [
                'pet_type_id' => 1,
                'name' => 'Parvovirus'
            ],
            [
                'pet_type_id' => 1,
                'name' => 'Leptospira'
            ],
            [
                'pet_type_id' => 1,
                'name' => 'Rabies'
            ],
            [
                'pet_type_id' => 1,
                'name' => 'Parainfluenza 2'
            ],
            [
                'pet_type_id' => 1,
                'name' => 'Bordetella'
            ],
            [
                'pet_type_id' => 2,
                'name' => 'Rhinotracheitis'
            ],
            [
                'pet_type_id' => 2,
                'name' => 'Calicivirus'
            ],
            [
                'pet_type_id' => 2,
                'name' => 'Panleukopenia'
            ],
            [
                'pet_type_id' => 2,
                'name' => 'Rabies'
            ],
            [
                'pet_type_id' => 2,
                'name' => 'Chlamydia'
            ],
            [
                'pet_type_id' => 2,
                'name' => 'Leukimia'
            ],
            [
                'pet_type_id' => 2,
                'name' => 'Infectious Peritonitis'
            ],
        ]);
    }
}
