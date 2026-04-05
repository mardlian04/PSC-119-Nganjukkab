<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'user_id',
        'judul_halaman',
        'slug',
        'isi_konten',
        'gambar_fitur'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}