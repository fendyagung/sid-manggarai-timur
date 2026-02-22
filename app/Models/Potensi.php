<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Potensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'desa_id',
        'nama_potensi',
        'kategori',
        'deskripsi',
        'foto_utama',
        'lokasi',
    ];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function galleries()
    {
        return $this->hasMany(PotensiGallery::class);
    }
}
