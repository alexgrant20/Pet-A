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

  public function province()
  {
    return $this->belongsTo(Province::class);
  }

  public function pet()
  {
    return $this->hasMany(Pet::class);
  }

  public function appointment()
  {
    return $this->hasMany(Appointment::class);
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
