<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan', 'bidang_usaha', 'no_telpon', 'nama_pimpinan', 'alamat',
    ];

    // Relasi ke mentor
    public function mentors()
    {
        return $this->belongsToMany(User::class, 'mitra_mentor', 'mitra_id', 'mentor_id');
    }

    // Relasi ke pembimbing
    public function pembimbings()
    {
        return $this->belongsToMany(User::class, 'mitra_pembimbing', 'mitra_id', 'pembimbing_id');
    }
}
