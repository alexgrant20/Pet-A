<?php

namespace Database\Seeders;

use App\Models\ServiceVeterinarianType;
use Illuminate\Database\Seeder;

class ServiceVeterinarianTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceVeterinarianType::insert([
            ['veterinarian_id' => 1,'service_type_id' => 1],
            ['veterinarian_id' => 1,'service_type_id' => 2],
            ['veterinarian_id' => 2,'service_type_id' => 1],
            ['veterinarian_id' => 2,'service_type_id' => 3],
            ['veterinarian_id' => 3,'service_type_id' => 1],
            ['veterinarian_id' => 4,'service_type_id' => 1],
            ['veterinarian_id' => 5,'service_type_id' => 1],
            ['veterinarian_id' => 6,'service_type_id' => 1],
            ['veterinarian_id' => 7,'service_type_id' => 1],
            ['veterinarian_id' => 8,'service_type_id' => 1],
            ['veterinarian_id' => 9,'service_type_id' => 1],
            ['veterinarian_id' => 10,'service_type_id' => 1],
            ['veterinarian_id' => 11,'service_type_id' => 1],
            ['veterinarian_id' => 12,'service_type_id' => 1],
            ['veterinarian_id' => 13,'service_type_id' => 1],
            ['veterinarian_id' => 14,'service_type_id' => 1],
            ['veterinarian_id' => 15,'service_type_id' => 1],
            ['veterinarian_id' => 16,'service_type_id' => 1],
            ['veterinarian_id' => 3,'service_type_id' => 2],
            ['veterinarian_id' => 4,'service_type_id' => 3],
            ['veterinarian_id' => 5,'service_type_id' => 2],
            ['veterinarian_id' => 6,'service_type_id' => 3],
            ['veterinarian_id' => 7,'service_type_id' => 2],
            ['veterinarian_id' => 8,'service_type_id' => 3],
            ['veterinarian_id' => 9,'service_type_id' => 2],
            ['veterinarian_id' => 10,'service_type_id' => 3],
            ['veterinarian_id' => 11,'service_type_id' => 2],
            ['veterinarian_id' => 12,'service_type_id' => 3],
            ['veterinarian_id' => 13,'service_type_id' => 2],
            ['veterinarian_id' => 14,'service_type_id' => 3],
            ['veterinarian_id' => 15,'service_type_id' => 2],
            ['veterinarian_id' => 16,'service_type_id' => 3]
        ]);
    }
}
