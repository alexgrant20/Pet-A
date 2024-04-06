<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'Pet Owner',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Veterinarian',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Clinic Admin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);
    }
}
