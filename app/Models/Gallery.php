<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'gambar',
        'deskripsi'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            $gallery->slug = Str::slug($gallery->judul) . '-' . uniqid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}