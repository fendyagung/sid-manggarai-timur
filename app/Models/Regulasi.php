<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regulasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'file_path',
        'deskripsi',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function downloads()
    {
        return $this->hasMany(RegulasiDownload::class);
    }

    public function isDownloadedBy($userId)
    {
        return $this->downloads()->where('user_id', $userId)->exists();
    }
}
