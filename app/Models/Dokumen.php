<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'judul',
        'file_path',
        'keterangan',
        'sender_id',
        'receiver_desa_id',
        'receiver_user_id',
        'is_read',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiverDesa()
    {
        return $this->belongsTo(Desa::class, 'receiver_desa_id');
    }

    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }
}
