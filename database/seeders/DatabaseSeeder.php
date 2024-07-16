<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            MenuSeeder::class,
            FieldSeeder::class,
            IconSeeder::class,
            PetMasterSeeder::class,
            Locationseeder::class,
            UserSeeder::class,
            PetSeeder::class,
            MedicationTypeSeeder::class,
            VaccinationSeeder::class,
            ServiceTypeSeeder::class,
            ServicePriceSeeder::class,
            AppointmentScheduleSeeder::class,
            AppointmentSeeder::class,
            AllergyCategorySeeder::class
        ]);
    }
}
