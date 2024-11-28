<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'gender',
        'email',
        'city',
        'profile_photo',
        'mentor_id',
        'pembimbing_id',
        'mitra_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi One-to-Many: Pembimbing/Mentor memiliki banyak siswa
    public function students()
    {
        return $this->hasMany(User::class, 'mentor_id'); // Mentor/pembimbing memiliki banyak siswa
    }

    // Relasi Many-to-One: Siswa memiliki mentor
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id'); // Siswa memiliki satu mentor
    }

    // Relasi Many-to-One: Siswa memiliki pembimbing
    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id'); // Siswa memiliki satu pembimbing
    }

     public function mitras()
    {
        return $this->belongsToMany(Mitra::class, 'mitra_pembimbing', 'pembimbing_id', 'mitra_id');
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

}
