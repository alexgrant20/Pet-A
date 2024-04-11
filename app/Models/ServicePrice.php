<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    use HasFactory;

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}