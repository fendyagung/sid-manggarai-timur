<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'subjek',
        'pesan',
        'lampiran',
        'original_name',
        'is_read',
        'is_read_desa',
        'balasan',
        'balasan_at',
    ];

    protected $casts = [
        'balasan_at' => 'datetime',
        'is_read' => 'boolean',
        'is_read_desa' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
