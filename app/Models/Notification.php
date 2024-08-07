<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
   use HasFactory;

   protected $guarded = ['id'];


   protected $casts = [
      'date_start' => 'datetime',
      'date_end' => 'datetime',
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function pet()
   {
      return $this->belongsTo(Pet::class);
   }
}
