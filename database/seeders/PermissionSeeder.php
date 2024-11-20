<?php

namespace Database\Seeders;

use App\Models\MenuPermission;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      Permission::insert([
         ['name' => 'pet-type-view'],
         ['name' => 'pet-type-create'],
         ['name' => 'pet-type-update'],
         ['name' => 'pet-type-delete'],
         ['name' => 'breed-view'],
         ['name' => 'breed-create'],
         ['name' => 'breed-update'],
         ['name' => 'breed-delete'],
         ['name' => 'city-view'],
         ['name' => 'city-create'],
         ['name' => 'city-update'],
         ['name' => 'city-delete'],
         ['name' => 'province-view'],
         ['name' => 'province-create'],
         ['name' => 'province-update'],
         ['name' => 'province-delete'],
         ['name' => 'appointment-type-view'],
         ['name' => 'appointment-type-create'],
         ['name' => 'appointment-type-update'],
         ['name' => 'appointment-type-delete'],
         ['name' => 'medication-type-view'],
         ['name' => 'medication-type-create'],
         ['name' => 'medication-type-update'],
         ['name' => 'medication-type-delete'],
         ['name' => 'vetrinarian-view'],
         ['name' => 'vetrinarian-create'],
         ['name' => 'vetrinarian-update'],
         ['name' => 'vetrinarian-delete'],
         ['name' => 'clinic-view'],
         ['name' => 'clinic-create'],
         ['name' => 'clinic-update'],
         ['name' => 'clinic-delete'],
         ['name' => 'appointment-view'],
         ['name' => 'appointment-create'],
         ['name' => 'appointment-update'],
         ['name' => 'appointment-schedule-view'],
         ['name' => 'appointment-schedule-create'],
         ['name' => 'appointment-schedule-update'],
         ['name' => 'appointment-schedule-delete'],
         ['name' => 'user-view'],
         ['name' => 'user-create'],
         ['name' => 'user-update'],
         ['name' => 'user-delete'],
      ]);

      MenuPermission::insert([
         [
            'menu_id' => 2,
            'permission_id' => 1
         ],
         [
            'menu_id' => 3,
            'permission_id' => 5
         ],
         [
            'menu_id' => 4,
            'permission_id' => 9
         ],
         [
            'menu_id' => 5,
            'permission_id' => 13
         ],
         [
            'menu_id' => 6,
            'permission_id' => 17
         ],
         [
            'menu_id' => 7,
            'permission_id' => 21
         ],
         [
            'menu_id' => 8,
            'permission_id' => 25
         ],
         [
            'menu_id' => 9,
            'permission_id' => 27
         ],
         [
            'menu_id' => 10,
            'permission_id' => 31
         ],
         [
            'menu_id' => 11,
            'permission_id' => 34
         ],
         [
            'menu_id' => 12,
            'permission_id' => 38
         ],
      ]);
   }
}
