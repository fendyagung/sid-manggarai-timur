<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'desa_id',
        'judul',
        'kategori',
        'keterangan',
        'file_path',
        'tanggal_laporan',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_laporan' => 'date',
    ];

    /**
     * Get the desa that the laporan belongs to.
     */
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}
