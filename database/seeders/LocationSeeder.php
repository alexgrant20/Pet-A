<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Locationseeder extends Seeder
{
  public function run(): void
  {
    $json = file_get_contents(public_path('sql/provinces.json'));
    $provinces = json_decode($json);

    foreach($provinces as $province)
    {
      Province::query()->updateOrCreate([
        "id" => $province->id,
        "name" => $province->name,
        "alt_name" => $province->alt_name,
        "latitude" => $province->latitude,
        "longitude" => $province->longitude,
      ]);
    }

    $json = file_get_contents(public_path('sql/regencies.json'));
    $cities = json_decode($json);

    foreach($cities as $city)
    {
      City::query()->updateOrCreate([
        "id" => $city->id,
        "province_id" => $city->province_id,
        "name" => $city->name,
        "alt_name" => $city->alt_name,
        "latitude" => $city->latitude,
        "longitude" => $city->longitude,
      ]);
    }


  }
}
