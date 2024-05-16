<?php

namespace Database\Seeders;

use App\Models\PetOwner;
use App\Models\User;
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
  }
}
