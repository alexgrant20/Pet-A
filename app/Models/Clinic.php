<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Clinic extends Model
{
    use HasFactory, HasRoles;

    protected $guarded = ['id'];

    public function veterinarian()
    {
        return $this->hasMany(Veterinarian::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function appointmentRequest()
    {
        return $this->hasMany(AppointmentRequest::class);
    }

    public function user()
    {
        return $this->morphMany(User::class, 'profile');
    }

    public function attachment()
    {
        return $this->morphMany(FieldAttachmentUpload::class, 'attachment');
    }
}
