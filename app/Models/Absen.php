<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tanggal', 'status'];

    // Pastikan kolom tanggal di-cast ke Carbon
    protected $casts = [
        'tanggal' => 'datetime', // atau 'date' jika hanya tanggal tanpa waktu
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
