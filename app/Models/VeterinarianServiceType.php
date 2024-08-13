<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeterinarianServiceType extends Model
{
   use HasFactory;

   protected $guarded = ['id'];

   public function serviceType()
   {
      return $this->belongsTo(ServiceType::class);
   }

   public function veterinarian()
   {
      return $this->belongsTo(Veterinarian::class);
   }
}
