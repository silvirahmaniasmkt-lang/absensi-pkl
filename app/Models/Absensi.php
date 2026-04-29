<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // <- WAJIB ditambah ini

class Absensi extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'keterangan',
        'keterangan_pulang'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}