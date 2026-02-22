<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaGallery extends Model
{
    protected $fillable = [
        'desa_id',
        'type',
        'url_or_path',
        'caption',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
