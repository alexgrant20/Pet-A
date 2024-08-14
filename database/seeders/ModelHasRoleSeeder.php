<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRoleSeeder extends Seeder
{
   public function run(): void
   {
      DB::table('model_has_roles')->insert([
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 'ba14172e-e443-47bf-95b6-bd644537da03'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '795ab5fe-9ebf-4798-a7f6-0a975557941b'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '2146591a-ead9-4f72-99d9-a67944a336f6'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '63099430-8fb5-4c16-b9b6-61594db87999'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 'c75c4f6a-a413-4407-a639-4ddefd2c4fdb'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '6735eaba-cb2c-4a81-b80f-a0b61be16880'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 'a5c5bbbc-3557-4a1d-8e76-80b19e456681'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '9d518c15-80d3-45cf-a9ad-161705dd4c56'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '63d08263-ca7e-49f7-9ae3-8cf344f16758'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 'a30d5347-3bab-4a46-b6bc-5ae3d4370258'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '66f5757d-638a-4785-9b66-c65b71357d0c'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '770af274-7fe5-4efe-ac73-8a2b0729de4d'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '3e838f17-0f50-4b32-9e47-c96e50488a9c'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 'bd7c1c96-efa0-4c6b-a38a-b55cb6e10ba2'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '2e40cfbd-ebf1-4084-8035-ce85eea42e5a'],
         ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => '18301379-7455-4684-8bb0-cfa556f19ce6'],
     ]);
   }
}
