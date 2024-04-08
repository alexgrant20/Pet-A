<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieModelsRole;

class Role extends SpatieModelsRole
{
   protected $guarded = ['id'];

   public function user()
   {
      return $this->hasMany(User::class);
   }
}
