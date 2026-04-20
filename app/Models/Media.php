<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'user_id',
        'judul_file',
        'kategori',
        'slug',
        'sampul_gambar',
        'tipe_file',
        'path_file',
        'keterangan'
    ];

    protected $casts = [
        'kategori' => 'string',
        'tipe_file' => 'string',
    ];

    protected static function booted()
    {
        static::creating(function ($media) {
            if (empty($media->slug)) {
                $media->slug = Str::slug($media->judul_file) . '-' . uniqid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getKategoriLabelAttribute()
    {
        return match ($this->kategori) {
            'media_cetak' => 'Media Cetak',
            'media_publikasi' => 'Media Publikasi',
            'infografis' => 'Infografis',
            default => '-',
        };
    }
}