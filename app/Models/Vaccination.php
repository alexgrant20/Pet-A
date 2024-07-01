<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function petType()
    {
        return $this->belongsTo(PetType::class);
    }
}
