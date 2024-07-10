<?php

namespace Database\Seeders;

use App\Models\ServicePrice;
use Illuminate\Database\Seeder;

class ServicePriceSeeder extends Seeder
{
   public function run(): void
   {
      ServicePrice::insert([
         [
            'veterinarian_id' => 1,
            'service_type_id' => 1,
            'price' => 100000
         ],
         [
            'veterinarian_id' => 1,
            'service_type_id' => 2,
            'price' => 300000
         ],
         [
            'veterinarian_id' => 1,
            'service_type_id' => 3,
            'price' => 400000
         ]
      ]);
   }
}
