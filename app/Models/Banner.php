<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'user_id','teks','sub_teks','path_gambar','urutan_priority','is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}