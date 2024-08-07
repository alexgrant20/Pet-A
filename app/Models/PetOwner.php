<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class PetOwner extends Model
{
  use HasFactory, HasRoles, SoftDeletes;

  protected $guarded = ['id'];

  public function city()
  {
    return $this->belongsTo(City::class);
  }

  public function pet()
  {
    return $this->hasMany(Pet::class);
  }

  public function appointment()
  {
    return $this->hasMany(Appointment::class);
  }

  public function appointmentRequest()
  {
    return $this->hasMany(AppointmentRequest::class);
  }

  public function onlineConsultationRequest()
  {
    return $this->hasMany(OnlineConsultationRequest::class);
  }

  public function onlineConsultation()
  {
    return $this->hasMany(OnlineConsultation::class);
  }

  public function user()
  {
    return $this->morphOne(User::class, 'profile');
  }

  public function attachment()
  {
    return $this->morphMany(FieldAttachmentUpload::class, 'attachment');
  }
}
