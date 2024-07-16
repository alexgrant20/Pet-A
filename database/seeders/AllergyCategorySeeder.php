<?php

namespace Database\Seeders;

use App\Models\AllergyCategory;
use Illuminate\Database\Seeder;

class AllergyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AllergyCategory::insert([
            ['id' => 1, 'name' => 'Mild', 'color_class' => 'blue-400'],
            ['id' => 2, 'name' => 'Moderete', 'color_class' => 'orange-400'],
            ['id' => 3, 'name' => 'Server', 'color_class' => 'red-400'],
        ]);
    }
}
