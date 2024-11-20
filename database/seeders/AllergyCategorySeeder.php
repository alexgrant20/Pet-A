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
            ['id' => 1, 'name' => 'Mild', 'color_class' => 'secondary'],
            ['id' => 2, 'name' => 'Moderate', 'color_class' => 'accent'],
            ['id' => 3, 'name' => 'Severe', 'color_class' => 'red-400'],
        ]);
    }
}
