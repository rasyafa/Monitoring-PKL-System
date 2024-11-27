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

    // Relasi Many-to-One: Siswa memiliki pembimbing atau mentor
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id'); // Siswa memiliki satu pembimbing/mentor
    }
}
