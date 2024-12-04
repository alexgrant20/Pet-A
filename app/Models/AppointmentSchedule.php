<?php

namespace App\Models;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
       'created_at' => 'datetime',
       'updated_at' => 'datetime',
       'start_time' => 'datetime',
    ];

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }
}
