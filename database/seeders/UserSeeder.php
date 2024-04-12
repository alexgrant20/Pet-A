<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'id' => '91550447-13c6-4b55-8644-452a261350c0',
            'email' => 'admin@dev.io',
            'password' => Hash::make('admin_test123')
        ]);

        $user->assignRole('admin');
    }
}
