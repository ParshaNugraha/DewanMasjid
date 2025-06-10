<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus'; // nama tabel

    protected $fillable = [
        'gambar', // kolom gambar yang boleh diisi mass assign
    ];
}
