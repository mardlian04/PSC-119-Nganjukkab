<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id','judul','slug','kategori','isi_konten',
        'gambar_thumbnail','status','jumlah_view'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}