<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'tag',
        'author_name',
        'author_id',
        'read_duration',
        'is_published',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

