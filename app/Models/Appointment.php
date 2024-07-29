<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
   use HasFactory;

   protected $guarded = ['id'];

   protected $dates = ['created_at', 'updated_at', 'appointment_date'];

   protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
      'appointment_date' => 'datetime',
   ];

   public function medicalRecord()
   {
      return $this->hasMany(MedicalRecord::class);
   }

   public function petOwner()
   {
      return $this->belongsTo(PetOwner::class);
   }

   public function pet()
   {
      return $this->belongsTo(Pet::class);
   }

   public function clinic()
   {
      return $this->belongsTo(Clinic::class);
   }

   public function appointmentType()
   {
      return $this->belongsTo(AppointmentType::class);
   }

   public function veterinarian()
   {
      return $this->belongsTo(Veterinarian::class);
   }

   public function appointmentSchedule()
   {
      return $this->belongsTo(AppointmentSchedule::class);
   }

   public function serviceType()
   {
      return $this->belongsTo(ServiceType::class);
   }
}
