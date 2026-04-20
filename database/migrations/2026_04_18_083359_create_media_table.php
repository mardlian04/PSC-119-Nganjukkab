<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('judul_file');
            $table->enum('kategori', ['media_cetak', 'media_publikasi', 'infografis']);
            $table->string('sampul_gambar')->nullable();
            $table->string('slug')->unique();
            $table->enum('tipe_file', ['image','pdf']);
            $table->string('path_file');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};