<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Appointment extends Model
{
   use HasFactory;

   protected $guarded = ['id'];

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
      return $this->belongsTo(Pet::class)->withTrashed();
   }

   public function clinic()
   {
      return $this->belongsTo(Clinic::class);
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

   public function rating()
   {
      return $this->hasOne(Rating::class);
   }

   public function getAppointmentDate()
   {
       return (new Carbon($this->appointment_date))->translatedFormat("l, d F Y");
   }

   public function getAppointmentTime()
   {
      $this->loadMissing('appointmentSchedule');

      $appointmentSchedule = $this->appointmentSchedule;
      $startTime = (new Carbon($appointmentSchedule->start_time))->translatedFormat("H:i");

      return "$startTime";
   }
}
