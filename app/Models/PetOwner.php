<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetOwner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function pet()
    {
        return $this->hasMany(Pet::class);
    }

    public function appoinment()
    {
        return $this->hasMany(Appoinment::class);
    }

    public function appoinmentRequest()
    {
        return $this->hasMany(AppoinmentRequest::class);
    }

    public function onlineConsultationRequest()
    {
        return $this->hasMany(OnlineConsultationRequest::class);
    }

    public function onlineConsultation()
    {
        return $this->hasMany(OnlineConsultation::class);
    }
}
