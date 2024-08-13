<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicSeeder extends Seeder
{
   public function run(): void
   {
      DB::table('clinics')->insert([
         ['id' => 1, 'city_id' => 3171, 'name' => 'Klinik Sehat Jakarta Selatan', 'phone_number' => '021-12345678', 'zip_code' => '12345', 'address' => 'Jl. Sehat No. 1, Jakarta Selatan', 'latitude' => '-6.2607', 'longitude' => '106.7816'],
         ['id' => 2, 'city_id' => 3201, 'name' => 'Klinik Harmoni Bogor', 'phone_number' => '0251-123456', 'zip_code' => '16111', 'address' => 'Jl. Harmoni No. 2, Bogor', 'latitude' => '-6.5950', 'longitude' => '106.8167'],
         ['id' => 3, 'city_id' => 3202, 'name' => 'Klinik Sukabumi Asri', 'phone_number' => '0266-123456', 'zip_code' => '43111', 'address' => 'Jl. Asri No. 3, Sukabumi', 'latitude' => '-6.9235', 'longitude' => '106.9286'],
         ['id' => 4, 'city_id' => 3203, 'name' => 'Klinik Sehat Cianjur', 'phone_number' => '0263-123456', 'zip_code' => '43211', 'address' => 'Jl. Sehat No. 4, Cianjur', 'latitude' => '-6.8173', 'longitude' => '107.1427'],
         ['id' => 5, 'city_id' => 3204, 'name' => 'Klinik Bandung Medika', 'phone_number' => '022-123456', 'zip_code' => '40111', 'address' => 'Jl. Medika No. 5, Bandung', 'latitude' => '-6.9147', 'longitude' => '107.6098'],
         ['id' => 6, 'city_id' => 3172, 'name' => 'Klinik Jakarta Timur', 'phone_number' => '021-22334455', 'zip_code' => '13420', 'address' => 'Jl. Timur No. 6, Jakarta Timur', 'latitude' => '-6.2210', 'longitude' => '106.8943'],
         ['id' => 7, 'city_id' => 3205, 'name' => 'Klinik Garut Mandiri', 'phone_number' => '0262-123456', 'zip_code' => '44111', 'address' => 'Jl. Mandiri No. 7, Garut', 'latitude' => '-7.2141', 'longitude' => '107.9008'],
         ['id' => 8, 'city_id' => 3206, 'name' => 'Klinik Tasikmalaya Sejahtera', 'phone_number' => '0265-123456', 'zip_code' => '46111', 'address' => 'Jl. Sejahtera No. 8, Tasikmalaya', 'latitude' => '-7.3274', 'longitude' => '108.2207'],
         ['id' => 9, 'city_id' => 3207, 'name' => 'Klinik Ciamis Lestari', 'phone_number' => '0265-654321', 'zip_code' => '46211', 'address' => 'Jl. Lestari No. 9, Ciamis', 'latitude' => '-7.3264', 'longitude' => '108.3534'],
         ['id' => 10, 'city_id' => 3208, 'name' => 'Klinik Kuningan Sentosa', 'phone_number' => '0232-123456', 'zip_code' => '45511', 'address' => 'Jl. Sentosa No. 10, Kuningan', 'latitude' => '-6.9750', 'longitude' => '108.4836'],
         ['id' => 11, 'city_id' => 3173, 'name' => 'Klinik Jakarta Pusat', 'phone_number' => '021-11223344', 'zip_code' => '10110', 'address' => 'Jl. Pusat No. 11, Jakarta Pusat', 'latitude' => '-6.1773', 'longitude' => '106.8227'],
         ['id' => 12, 'city_id' => 3209, 'name' => 'Klinik Cirebon Utama', 'phone_number' => '0231-123456', 'zip_code' => '45111', 'address' => 'Jl. Utama No. 12, Cirebon', 'latitude' => '-6.7320', 'longitude' => '108.5523'],
         ['id' => 13, 'city_id' => 3210, 'name' => 'Klinik Majalengka Harapan', 'phone_number' => '0233-123456', 'zip_code' => '45411', 'address' => 'Jl. Harapan No. 13, Majalengka', 'latitude' => '-6.8373', 'longitude' => '108.2274'],
         ['id' => 14, 'city_id' => 3211, 'name' => 'Klinik Sumedang Prima', 'phone_number' => '0231-654321', 'zip_code' => '45311', 'address' => 'Jl. Prima No. 14, Sumedang', 'latitude' => '-6.8540', 'longitude' => '107.9229'],
         ['id' => 15, 'city_id' => 3212, 'name' => 'Klinik Indramayu Sehat', 'phone_number' => '0234-123456', 'zip_code' => '45211', 'address' => 'Jl. Sehat No. 15, Indramayu', 'latitude' => '-6.3376', 'longitude' => '108.3240'],
         ['id' => 16, 'city_id' => 3213, 'name' => 'Klinik Subang Mandiri', 'phone_number' => '0260-123456', 'zip_code' => '41211', 'address' => 'Jl. Mandiri No. 16, Subang', 'latitude' => '-6.5743', 'longitude' => '107.7617'],
         ['id' => 17, 'city_id' => 3214, 'name' => 'Klinik Purwakarta Harmoni', 'phone_number' => '0264-123456', 'zip_code' => '41111', 'address' => 'Jl. Harmoni No. 17, Purwakarta', 'latitude' => '-6.5570', 'longitude' => '107.4424'],
         ['id' => 18, 'city_id' => 3215, 'name' => 'Klinik Karawang Utama', 'phone_number' => '0267-123456', 'zip_code' => '41311', 'address' => 'Jl. Utama No. 18, Karawang', 'latitude' => '-6.3232', 'longitude' => '107.3379'],
         ['id' => 19, 'city_id' => 3216, 'name' => 'Klinik Bekasi Medika', 'phone_number' => '021-87654321', 'zip_code' => '17111', 'address' => 'Jl. Medika No. 19, Bekasi', 'latitude' => '-6.2416', 'longitude' => '107.0050'],
         ['id' => 20, 'city_id' => 3217, 'name' => 'Klinik Bandung Barat Prima', 'phone_number' => '022-987654', 'zip_code' => '40511', 'address' => 'Jl. Prima No. 20, Bandung Barat', 'latitude' => '-6.8377', 'longitude' => '107.5425'],
      ]);
   }
}
