<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\PetOwner;
use App\Models\User;
use App\Models\Veterinarian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   public function run(): void
   {
      PetOwner::create([])
         ->user()
         ->create([
            'id' => 'e2d8f99f-7f8c-438d-a041-939ccbc35f1a',
            'name' => 'Pet Owner Dummy',
            'email' => 'pet_owner@dev.io',
            'password' => 'petOwner123'
         ])
         ->assignRole('pet-owner');

      User::create([
         'id' => '91550447-13c6-4b55-8644-452a261350c0',
         'name' => 'pet-a god',
         'email' => 'admin@dev.io',
         'password' => Hash::make('admin_test123')
      ])
         ->assignRole('admin');

      Clinic::create([
         'name' => 'Klinik Dummy'
      ]);
      Veterinarian::create([
         'clinic_id' => 1,
         'length_of_service' => 1
      ])
         ->user()
         ->create([
            'id' => '083a924c-3e20-4a3c-9479-336cb85ab5a5',
            'name' => 'Veterinarian Dummy',
            'email' => 'veterinarian@dev.io',
            'password' => Hash::make('veterinarian123')
         ])
         ->assignRole('veterinarian');
   }
}
