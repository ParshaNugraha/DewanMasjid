<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'username',
        'email', 
        'password',
        'role',
        'status',
    ];

    // Kolom yang harus disembunyikan saat model diubah jadi array atau JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi User ke Masjid (1 user punya 1 masjid)
     * 
     * @return HasOne
     */
    public function masjid(): HasOne
    {
        return $this->hasOne(Masjid::class);
    }
}
