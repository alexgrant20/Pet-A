<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetMedication extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
}
