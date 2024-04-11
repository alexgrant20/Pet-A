<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetMedicationSchedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function petMedication()
    {
        return $this->belongsTo(PetMedication::class);
    }
}
