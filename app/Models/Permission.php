<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Models\Permission as SpatieModelsPermission;

class Permission extends SpatieModelsPermission
{
   protected $guarded = ['id'];

   /**
    * Get the user's first name.
    *
    * @return \Illuminate\Database\Eloquent\Casts\Attribute
    */
   protected function nameFormated(): Attribute
   {
      return Attribute::make(
         get: fn ($value) => ucwords(str_replace('-', ' ', $this->name)),
      );
   }

   public function menuPermission()
   {
       return $this->belongsTo(MenuPermission::class);
   }
}
