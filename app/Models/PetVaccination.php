<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetVaccination extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function vaccination()
    {
        return $this->belongsTo(Vaccination::class);
    }
}
