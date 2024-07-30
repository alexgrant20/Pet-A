<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'start_time'];

    protected $casts = [
       'created_at' => 'datetime',
       'updated_at' => 'datetime',
       'start_time' => 'datetime',
    ];

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }

    public function appointmentRequest()
    {
        return $this->hasMany(AppointmentRequest::class);
    }
}
