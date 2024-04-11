<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function petMedication()
    {
        return $this->hasManyThrough(PetMedication::class, MedicalRecordTreatment::class);
    }

    public function appoinment()
    {
        return $this->belongsTo(Appoinment::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
