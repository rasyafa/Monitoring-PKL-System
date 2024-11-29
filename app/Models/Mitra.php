<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan', 'bidang_usaha', 'no_telpon', 'nama_pimpinan', 'alamat', 'mentor_id',
        'pembimbing_id',
    ];

    // Relasi ke mentor
    public function pembimbings()
    {
        return $this->belongsToMany(User::class, 'mitra_pembimbing', 'mitra_id', 'pembimbing_id');
    }

    public function mentors()
    {
        return $this->hasMany(User::class, 'mitra_id')->where('role', 'mentor');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'mitra_id'); // Relasi mitra ke banyak siswa
    }
}
