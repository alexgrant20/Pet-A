<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'pet-owner',
        ]);

        Role::create([
            'name' => 'veterinarian',
        ]);

        Role::create([
            'name' => 'clinic-admin',
        ]);

        Role::create([
            'name' => 'admin',
        ]);
    }
}
