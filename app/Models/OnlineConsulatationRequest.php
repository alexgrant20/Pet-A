<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineConsultationRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function petOwner()
    {
        return $this->belongsTo(PetOwner::class);
    }

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }
}
