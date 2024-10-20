<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetMedication extends Model
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

   public function medicationType()
   {
      return $this->belongsTo(MedicationType::class);
   }

   public function medicalRecord()
   {
      return $this->hasOneThrough(MedicalRecord::class, MedicalRecordTreatment::class);
   }

   public function petMedicationSchedule()
   {
      return $this->hasMany(PetMedicationSchedule::class);
   }

   public function getGivenAtAttribute($value)
   {
       return Carbon::parse($value)->format('d-m-Y');
   }
}
