<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppoinmentSchedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }

    public function appoinmentRequest()
    {
        return $this->hasMany(AppoinmentRequest::class);
    }
}
