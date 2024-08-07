<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function vaccinationType()
    {
        return $this->hasMany(Vaccination::class);
    }

    public function icon()
    {
      return $this->belongsTo(Icon::class);
    }
}
