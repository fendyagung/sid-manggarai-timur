<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'isi',
        'foto',
        'kategori',
        'is_published',
    ];

    /**
     * Get the user that owns the news.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status string based on is_published.
     */
    public function getStatusAttribute(): string
    {
        return $this->is_published ? 'publikasi' : 'draft';
    }

    /**
     * Get the author name.
     */
    public function getPenulisAttribute(): string
    {
        return $this->user ? $this->user->name : 'Admin';
    }

    /**
     * Boot function to automatically generate slug.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul) . '-' . uniqid();
        });
    }
}
