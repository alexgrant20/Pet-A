<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Veterinarian extends Model
{
   use HasFactory, HasRoles, SoftDeletes;

   protected $guarded = ['id'];

   public function clinic()
   {
      return $this->belongsTo(Clinic::class);
   }

   public function veterinarianServiceType()
   {
      return $this->hasMany(VeterinarianServiceType::class);
   }

   public function appointmentSchedule()
   {
      return $this->hasMany(AppointmentSchedule::class);
   }

   public function appointment()
   {
      return $this->hasMany(Appointment::class);
   }

   public function user()
   {
      return $this->morphOne(User::class, 'profile');
   }

   public function petType()
   {
      return $this->belongsToMany(PetType::class, VeterinarianPetType::class);
   }

   public function ratings()
   {
      return $this->hasManyThrough(Rating::class, Appointment::class);
   }

   public function attachment()
   {
      return $this->morphMany(FieldAttachmentUpload::class, 'attachment');
   }
}
