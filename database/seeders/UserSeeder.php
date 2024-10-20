<?php

namespace Database\Seeders;

use App\Models\PetOwner;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
   public function run(): void
   {
      DB::table('users')->insert([
         ['id' => "ba14172e-e443-47bf-95b6-bd644537da03", 'email' => 'ahmad@example.com', 'password' => bcrypt('password'), 'name' => 'Ahmad Setiawan', 'address' => 'Jl. Merdeka No. 1', 'birth_date' => '1990-05-21', 'gender' => 'm', 'phone_number' => '081234567890', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 1],
         ['id' => "795ab5fe-9ebf-4798-a7f6-0a975557941b", 'email' => 'budi@example.com', 'password' => bcrypt('password'), 'name' => 'Budi Santoso', 'address' => 'Jl. Kemerdekaan No. 2', 'birth_date' => '1988-09-15', 'gender' => 'm', 'phone_number' => '081234567891', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 2],
         ['id' => "2146591a-ead9-4f72-99d9-a67944a336f6", 'email' => 'lukas@example.com', 'password' => bcrypt('password'), 'name' => 'Lukas Edambe', 'address' => 'Jl. Pancasila No. 3', 'birth_date' => '1985-12-05', 'gender' => 'm', 'phone_number' => '081234567892', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 3],
         ['id' => "63099430-8fb5-4c16-b9b6-61594db87999", 'email' => 'william@example.com', 'password' => bcrypt('password'), 'name' => 'William Charles', 'address' => 'Jl. Kebangsaan No. 4', 'birth_date' => '1992-01-30', 'gender' => 'm', 'phone_number' => '081234567893', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 4],
         ['id' => "c75c4f6a-a413-4407-a639-4ddefd2c4fdb", 'email' => 'steven@example.com', 'password' => bcrypt('password'), 'name' => 'Steven Wongso', 'address' => 'Jl. Patriot No. 5', 'birth_date' => '1987-07-10', 'gender' => 'm', 'phone_number' => '081234567894', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 5],
         ['id' => "6735eaba-cb2c-4a81-b80f-a0b61be16880", 'email' => 'fajar@example.com', 'password' => bcrypt('password'), 'name' => 'Fajar Firmansyah', 'address' => 'Jl. Persatuan No. 6', 'birth_date' => '1993-03-15', 'gender' => 'm', 'phone_number' => '081234567895', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 6],
         ['id' => "a5c5bbbc-3557-4a1d-8e76-80b19e456681", 'email' => 'charlie@example.com', 'password' => bcrypt('password'), 'name' => 'Charlie Andersen', 'address' => 'Jl. Reformasi No. 7', 'birth_date' => '1991-11-25', 'gender' => 'm', 'phone_number' => '081234567896', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 7],
         ['id' => "9d518c15-80d3-45cf-a9ad-161705dd4c56", 'email' => 'hendra@example.com', 'password' => bcrypt('password'), 'name' => 'Hendra Wijaya', 'address' => 'Jl. Solidaritas No. 8', 'birth_date' => '1986-02-28', 'gender' => 'm', 'phone_number' => '081234567897', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 8],
         ['id' => "63d08263-ca7e-49f7-9ae3-8cf344f16758", 'email' => 'calista@example.com', 'password' => bcrypt('password'), 'name' => 'Calista Huang', 'address' => 'Jl. Harapan No. 9', 'birth_date' => '1990-04-11', 'gender' => 'f', 'phone_number' => '081234567898', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 9],
         ['id' => "a30d5347-3bab-4a46-b6bc-5ae3d4370258", 'email' => 'caryn@example.com', 'password' => bcrypt('password'), 'name' => 'Caryn Widjaya', 'address' => 'Jl. Srikandi No. 10', 'birth_date' => '1989-08-17', 'gender' => 'f', 'phone_number' => '081234567899', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 10],
         ['id' => "66f5757d-638a-4785-9b66-c65b71357d0c", 'email' => 'karin@example.com', 'password' => bcrypt('password'), 'name' => 'Karin Wulandari', 'address' => 'Jl. Melati No. 11', 'birth_date' => '1992-12-12', 'gender' => 'f', 'phone_number' => '081234567900', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 11],
         ['id' => "770af274-7fe5-4efe-ac73-8a2b0729de4d", 'email' => 'maruna@example.com', 'password' => bcrypt('password'), 'name' => 'Maruna Desmawarni', 'address' => 'Jl. Mawar No. 12', 'birth_date' => '1988-05-05', 'gender' => 'f', 'phone_number' => '081234567901', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 12],
         ['id' => "3e838f17-0f50-4b32-9e47-c96e50488a9c", 'email' => 'maya@example.com', 'password' => bcrypt('password'), 'name' => 'Maya Sari', 'address' => 'Jl. Anggrek No. 13', 'birth_date' => '1991-09-09', 'gender' => 'f', 'phone_number' => '081234567902', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 13],
         ['id' => "bd7c1c96-efa0-4c6b-a38a-b55cb6e10ba2", 'email' => 'nina@example.com', 'password' => bcrypt('password'), 'name' => 'Nina Angelina', 'address' => 'Jl. Kenanga No. 14', 'birth_date' => '1994-11-11', 'gender' => 'f', 'phone_number' => '081234567903', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 14],
         ['id' => "2e40cfbd-ebf1-4084-8035-ce85eea42e5a", 'email' => 'ocha@example.com', 'password' => bcrypt('password'), 'name' => 'Ocha Natasya', 'address' => 'Jl. Kamboja No. 15', 'birth_date' => '1990-01-01', 'gender' => 'f', 'phone_number' => '081234567904', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 15],
         ['id' => "18301379-7455-4684-8bb0-cfa556f19ce6", 'email' => 'lina@example.com', 'password' => bcrypt('password'), 'name' => 'Lina Lorena', 'address' => 'Jl. Melur No. 16', 'birth_date' => '1987-07-07', 'gender' => 'f', 'phone_number' => '081234567905', 'profile_type' => 'App\Models\Veterinarian', 'profile_id' => 16],
      ]);

      for ($i = 1; $i <= 20; $i++) {
         User::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Clinic User-' . $i,
            'email' => 'clinic' . $i . '@dev.io',
            'password' => Hash::make('password'),
            'profile_type' => 'App\Models\Clinic',
            'profile_id' => $i,
         ])
            ->assignRole('clinic-admin');
      }

      PetOwner::create([])
         ->user()
         ->create([
            'id' => 'e2d8f99f-7f8c-438d-a041-939ccbc35f1a',
            'name' => 'Pet Owner Dummy',
            'phone_number' => '08123122342',
            'email' => 'pet_owner@dev.io',
            'password' => Hash::make('password')
         ])
         ->assignRole('pet-owner');

      User::create([
         'id' => '91550447-13c6-4b55-8644-452a261350c0',
         'name' => 'pet-a god',
         'email' => 'admin@dev.io',
         'password' => Hash::make('password')
      ])
         ->assignRole('admin');
   }
}
