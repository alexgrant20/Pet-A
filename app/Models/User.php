<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles, HasUuids;

    protected $guarded = [''];
    protected $hidden = ['password'];

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function accounts()
    {
        return $this->hasMany(LinkedSocialAccount::class);
    }
}
