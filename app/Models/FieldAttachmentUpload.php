<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldAttachmentUpload extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function attachment() {
        return $this->morphTo();
    }
}
