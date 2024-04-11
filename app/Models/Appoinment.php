<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function medicalRecord()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function petOwner()
    {
        return $this->belongsTo(PetOwner::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function appoinmentType()
    {
        return $this->belongsTo(AppoinmentType::class);
    }

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }
}
