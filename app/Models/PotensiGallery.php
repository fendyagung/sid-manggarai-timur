<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PotensiGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'potensi_id',
        'foto',
    ];

    public function potensi(): BelongsTo
    {
        return $this->belongsTo(Potensi::class);
    }
}
