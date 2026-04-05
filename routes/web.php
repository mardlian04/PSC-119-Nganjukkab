<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/postingan/{slug}', [HomeController::class, 'show'])->name('postingan.post.detail');
Route::get('/halaman/{slug}', [HomeController::class, 'pageDetail'])
    ->name('halaman.index');
Route::get('/postingan', [PostController::class, 'publicIndex'])
    ->name('postingan.index');
Route::get('/galeri', [GalleryController::class, 'publicIndex'])
    ->name('galeri.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('pages', PageController::class);
    Route::post('ckeditor/upload', [PageController::class, 'upload'])->name('ckeditor.upload');
    Route::resource('menu', MenuController::class);
    Route::resource('galleries', GalleryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';