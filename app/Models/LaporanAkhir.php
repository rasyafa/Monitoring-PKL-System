<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanAkhir extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'file_path',
        'tanggal',
    ];

    protected $dates = ['tanggal'];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}