<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function servicePrice()
    {
        return $this->hasMany(ServicePrice::class);
    }
}
