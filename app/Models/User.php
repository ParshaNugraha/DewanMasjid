<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_masjid',
        'nama_takmir',
        'tahun',
        'status_tanah',
        'topologi_masjid',
        'kecamatan',
        'kabupaten',
        'alamat',
        'username',
        'password',
        'gambar',
        'surat',
        'notlp',
        'role'
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
            'tahun' => 'integer',
            'password' => 'hashed',
        ];
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperadmin()
    {
        return $this->role === 'superadmin';
    }
    /**
     * Get the username field for authentication.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
}