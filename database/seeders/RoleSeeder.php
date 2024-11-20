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
        ])->syncPermissions([31, 32, 33, 34, 35, 36, 37]);

        Role::create([
            'name' => 'clinic-admin',
        ]);

        Role::create([
            'name' => 'admin',
        ])->syncPermissions([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 38, 39, 40, 41]);
    }
}
