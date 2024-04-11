<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function servicePrice()
    {
        return $this->hasMany(ServicePrice::class);
    }

    public function appointmentSchedule()
    {
        return $this->hasMany(AppoinmentSchedule::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appoinment::class);
    }

    public function onlineConsultation()
    {
        return $this->hasMany(OnlineConsultation::class);
    }
}
