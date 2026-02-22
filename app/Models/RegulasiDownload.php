<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegulasiDownload extends Model
{
    use HasFactory;

    protected $fillable = ['regulasi_id', 'user_id', 'downloaded_at'];

    public function regulasi()
    {
        return $this->belongsTo(Regulasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
