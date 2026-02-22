<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DpmdGallery extends Model
{
    protected $fillable = [
        'dpmd_profile_id',
        'type',
        'url_or_path',
        'caption',
    ];

    public function profile()
    {
        return $this->belongsTo(DpmdProfile::class, 'dpmd_profile_id');
    }
}
