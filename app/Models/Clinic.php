<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function veterinarian()
    {
        return $this->hasMany(Veterinarian::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function appoinment()
    {
        return $this->hasMany(Appoinment::class);
    }

    public function appoinmentRequest()
    {
        return $this->hasMany(AppoinmentRequest::class);
    }
}
