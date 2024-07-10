<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicePrice extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
