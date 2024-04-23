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
				'label' => 'master',
				'order' => 1,
			]);

    }
}
