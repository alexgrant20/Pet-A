<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
  public function run(): void
  {
    $masterMenu = Menu::create([
      'icon' => 'fa fa-database',
      'label' => 'Master',
      'order' => 1,
    ]);

    Menu::create([
      'label' => 'Pet Type',
      'order' => 1,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.pet-type.index'
    ]);

    Menu::create([
      'label' => 'Breed',
      'order' => 2,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.breed.index'
    ]);

    Menu::create([
      'label' => 'City',
      'order' => 3,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.city.index'
    ]);

    Menu::create([
      'label' => 'Province',
      'order' => 4,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.province.index'
    ]);

    Menu::create([
      'label' => 'Appointment Type',
      'order' => 5,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.appointment-type.index'
    ]);

    Menu::create([
      'label' => 'Medication Type',
      'order' => 6,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.medication-type.index'
    ]);

    Menu::create([
      'label' => 'Payment Type',
      'order' => 7,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.payment-type.index'
    ]);

    Menu::create([
      'label' => 'Vaccination Type',
      'order' => 8,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.vaccination.index'
    ]);

    Menu::create([
      'label' => 'Veterinarian',
      'order' => 2,
      'icon' => 'fa fa-user-doctor',
      'route_name' => 'admin.veterinarian.index'
    ]);

    Menu::create([
      'label' => 'Pets',
      'order' => 1,
      'is_pet_owner' => true,
      'route_name' => 'pet-owner.pet.index',
    ]);

    Menu::create([
      'label' => 'Online Consultation',
      'order' => 2,
      'is_pet_owner' => true,
      'route_name' => 'pet-owner.online-consultation.index',
    ]);

    Menu::create([
      'label' => 'Appointment',
      'order' => 3,
      'is_pet_owner' => true,
      'route_name' => 'pet-owner.appointment.index',
    ]);

    Menu::create([
      'label' => 'Vaccination',
      'order' => 4,
      'is_pet_owner' => true,
      'route_name' => 'pet-owner.vaccination.index',
    ]);

    Menu::create([
      'label' => 'Medical Record',
      'order' => 5,
      'is_pet_owner' => true,
      'route_name' => 'pet-owner.medical-record.index',
    ]);

    Menu::create([
      'icon' => 'fa-users',
      'label' => 'User Management',
      'order' => 2,
      'route_name' => 'admin.user-management.index'
   ]);
  }
}
