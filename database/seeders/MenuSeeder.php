<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
	public function run(): void
	{
		Menu::create([
			'icon' => 'fa fa-database',
			'label' => 'Master',
			'order' => 1,
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
			'label' => 'Appoinment',
			'order' => 2,
			'is_pet_owner' => true,
			'route_name' => 'pet-owner.appoinment.index',
		]);

		Menu::create([
			'label' => 'Vaccination',
			'order' => 3,
			'is_pet_owner' => true,
			'route_name' => 'pet-owner.vaccination.index',
		]);

		Menu::create([
			'label' => 'Medical Record',
			'order' => 3,
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
