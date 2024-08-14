<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldAttachmentUploadSeeder extends Seeder
{
   public function run(): void
   {
      DB::table('field_attachment_uploads')->insert([
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/1.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 1],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/2.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 2],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/3.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 3],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/4.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 4],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/5.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 5],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/6.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 6],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/7.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 7],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/8.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 8],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/9.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 9],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/10.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 10],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/11.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 11],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/12.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 12],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/13.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 13],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/14.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 14],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/15.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 15],
         ['field_id' => 2, 'path' => 'storage/assets/veterinarian/16.jpg', 'attachment_type' => 'App\Models\Veterinarian', 'attachment_id' => 16],
         ['field_id' => 1, 'path' => 'storage/assets/pet/dog-1.jpg', 'attachment_type' => 'App\Models\Pet', 'attachment_id' => 1],
         ['field_id' => 1, 'path' => 'storage/assets/pet/dog-2.jpg', 'attachment_type' => 'App\Models\Pet', 'attachment_id' => 2],
         ['field_id' => 1, 'path' => 'storage/assets/pet/dog-3.jpg', 'attachment_type' => 'App\Models\Pet', 'attachment_id' => 3],
     ]);
   }
}
