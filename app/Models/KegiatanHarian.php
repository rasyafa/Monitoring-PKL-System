<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KegiatanHarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'kegiatan',
        'status',
        'catatan',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
