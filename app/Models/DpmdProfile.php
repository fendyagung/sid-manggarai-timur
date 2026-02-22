<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DpmdProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function galleries()
    {
        return $this->hasMany(DpmdGallery::class, 'dpmd_profile_id');
    }
}
