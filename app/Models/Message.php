<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = ['id', 'user_id', 'text', 'online_consultation_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function getTimeAttribute()
  {
    return date(
      "d M Y, H:i:s",
      strtotime($this->attributes['created_at'])
    );
  }
}
