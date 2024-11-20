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
      'order' => 7,
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
      'label' => 'Service Type',
      'order' => 5,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.service-type.index'
    ]);

    Menu::create([
      'label' => 'Medication Type',
      'order' => 6,
      'parent_id' => $masterMenu->id,
      'route_name' => 'admin.master.medication-type.index'
    ]);

   //  Menu::create([
   //    'label' => 'Vaccination Type',
   //    'order' => 8,
   //    'parent_id' => $masterMenu->id,
   //    'route_name' => 'admin.master.vaccination.index'
   //  ]);

    Menu::create([
      'label' => 'Veterinarian',
      'order' => 5,
      'icon' => 'fa fa-user-doctor',
      'route_name' => 'admin.veterinarian.index'
    ]);

    Menu::create([
      'label' => 'Clinic',
      'order' => 4,
      'icon' => 'fa fa-hospital',
      'route_name' => 'admin.clinic.index'
    ]);

    Menu::create([
      'label' => 'Appointment',
      'order' => 1,
      'icon' => 'fa-solid fa-paw',
      'route_name' => 'admin.appointment.index'
    ]);

    Menu::create([
      'label' => 'Schedule',
      'order' => 1,
      'icon' => 'fa fa-calendar-days',
      'route_name' => 'admin.appointment-schedule.index'
    ]);

    Menu::create([
      'icon' => 'fa-users',
      'label' => 'User Management',
      'order' => 6,
      'route_name' => 'admin.user-management.index'
   ]);

    Menu::create([
      'label' => 'Pets',
      'order' => 1,
      'is_pet_owner' => true,
      'route_name' => 'pet-owner.pet.index',
      'icon' => 'fa fa-paw',
    ]);

   //  Menu::create([
   //    'label' => 'Online Consultation',
   //    'order' => 2,
   //    'is_pet_owner' => true,
   //    'route_name' => 'pet-owner.online-consultation.index',
   //  ]);

    Menu::create([
      'label' => 'Appointment',
      'order' => 3,
      'is_pet_owner' => true,
      'route_name' => 'pet-owner.appointment.index',
      'icon' => 'fa fa-calendar',
    ]);

   //  Menu::create([
   //    'label' => 'Vaccination',
   //    'order' => 4,
   //    'is_pet_owner' => true,
   //    'route_name' => 'pet-owner.vaccination.index',
   //  ]);

   //  Menu::create([
   //    'label' => 'Medical Record',
   //    'order' => 5,
   //    'is_pet_owner' => true,
   //    'route_name' => 'pet-owner.medical-record.index',
   //  ]);

    Menu::create([
      'icon' => 'fa-message',
      'label' => 'User Support',
      'order' => 7,
      'route_name' => 'admin.chat.index'
   ]);
  }
}
