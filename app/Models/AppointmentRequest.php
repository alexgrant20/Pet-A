<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function petOwner()
    {
        return $this->belongsTo(PetOwner::class);
    }

    public function appoinmentSchedule()
    {
        return $this->belongsTo(AppointmentSchedule::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function appoinmentType()
    {
        return $this->belongsTo(AppointmentType::class);
    }

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }
}
