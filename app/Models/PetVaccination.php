<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetVaccination extends Model
{
   use HasFactory;

   protected $guarded = ['id'];

   protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
      'given_at' => 'datetime',
   ];

   public function pet()
   {
      return $this->belongsTo(Pet::class);
   }

   public function vaccination()
   {
      return $this->belongsTo(Vaccination::class);
   }

   public function getGivenAtAttribute($value)
   {
       return Carbon::parse($value)->format('m/d/Y');
   }
}
