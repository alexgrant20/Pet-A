<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pet()
    {
        return $this->hasMany(Pet::class);
    }

    public function petType()
    {
        return $this->belongsTo(PetType::class);
    }
}
