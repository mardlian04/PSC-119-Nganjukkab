<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'user_id',
        'judul_file',
        'slug',
        'tipe_file',
        'path_file',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}