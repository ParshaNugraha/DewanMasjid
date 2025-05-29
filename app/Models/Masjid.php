<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Masjid extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika sesuai konvensi Laravel)
    protected $table = 'masjids';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'nama_masjid',
        'nama_takmir',
        'tahun',
        'status_tanah',
        'topologi_masjid',
        'kecamatan',
        'kabupaten',
        'alamat',
        'gambar',
        'surat',
        'notlp',
    ];

    // Casting tipe data untuk atribut tertentu
    protected $casts = [
        'tahun' => 'integer',
    ];

    /**
     * Relasi Masjid ke User (admin pemilik masjid)
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
