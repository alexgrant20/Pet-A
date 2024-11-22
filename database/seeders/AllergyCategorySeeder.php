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
            ['name' => 'Mild', 'color_class' => 'secondary'],
            ['name' => 'Moderate', 'color_class' => 'accent'],
            ['name' => 'Severe', 'color_class' => 'red-400'],
        ]);
    }
}
