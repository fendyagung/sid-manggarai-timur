<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_desa',
        'jenis',
        'kode_desa',
        'kecamatan',
        'kepala_desa',
        'deskripsi',
        'foto_profil',
        'lokasi_maps',
        'is_desa_wisata',
        'user_id',
        'video_youtube',
        'jumlah_penduduk',
        'jumlah_kk',
        'luas_wilayah',
        'deskripsi_batas',
        'potensi_ekonomi',
    ];

    /**
     * Get the user (Admin Desa) that owns the desa.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the laporans for the desa.
     */
    /**
     * Get the laporans for the desa.
     */
    public function laporans(): HasMany
    {
        return $this->hasMany(Laporan::class);
    }

    /**
     * Get the galleries for the desa.
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(DesaGallery::class);
    }

    public function potensis(): HasMany
    {
        return $this->hasMany(Potensi::class);
    }
}
