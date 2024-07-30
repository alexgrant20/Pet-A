<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pet extends Model
{
   use HasFactory;

   protected $guarded = ['id'];

   protected $casts = [
      'birth_date' => 'datetime',
   ];

   public function petOwner()
   {
      return $this->belongsTo(PetOwner::class);
   }

   public function breed()
   {
      return $this->belongsTo(Breed::class);
   }

   public function petMedication()
   {
      return $this->hasMany(PetMedication::class);
   }

   public function petVaccination()
   {
      return $this->hasMany(PetVaccination::class);
   }

   public function medicalRecord()
   {
      return $this->hasMany(MedicalRecord::class);
   }

   public function petAllergy()
   {
      return $this->hasMany(PetAllergy::class);
   }

   public function attachment()
   {
      return $this->morphMany(FieldAttachmentUpload::class, 'attachment');
   }

   public function petWeight()
   {
      return $this->hasMany(PetWeight::class);
   }

   public function appointment()
   {
      return $this->hasMany(Appointment::class);
   }

   public function getAge()
   {
      $age = null;
      $birthDate = new Carbon($this->birth_date);
      $ageYear = date_diff($birthDate, now())->format("%y");
      $ageMonth = date_diff($birthDate, now())->format("%m");

      if ($ageYear > 0 && $ageMonth > 0) $age = "$ageYear tahun $ageMonth bulan";
      else if ($ageYear > 0) $age = $ageYear  . " tahun";
      else if ($ageMonth > 0) $age = $ageMonth . " bulan";

      return $age;
   }
}
