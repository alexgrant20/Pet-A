<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetVaccination extends Model
{
   use HasFactory;

   protected $guarded = ['id'];

   protected $dates = [
      'given_at'
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
       return Carbon::parse($value)->format('m/d/y');
   }
}
