<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MenuSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            FieldSeeder::class,
            IconSeeder::class,
            PetMasterSeeder::class,
            LocationSeeder::class,
            ClinicSeeder::class,
            UserSeeder::class,
            VeterinarianSeeder::class,
            PetSeeder::class,
            MedicationTypeSeeder::class,
            VaccinationSeeder::class,
            ServiceTypeSeeder::class,
            AppointmentScheduleSeeder::class,
            AppointmentSeeder::class,
            AllergyCategorySeeder::class,
            FieldAttachmentUploadSeeder::class,
            ModelHasRoleSeeder::class,
            VeterinarianPetTypeSeeder::class,
            VeterinarianServiceTypeSeeder::class
        ]);
    }
}
