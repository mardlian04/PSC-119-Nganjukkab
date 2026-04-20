<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Banner;
use App\Models\Page;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::first();
        $posts = Post::latest()->take(4)->get();
        $galeri = Gallery::latest()->take(10)->get();

        return view('welcome', compact('banner', 'posts', 'galeri'));
    }
    
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        $post->increment('jumlah_view');

        $beritaLainnya = Post::where('status', 'publish')
            ->where('id', '!=', $post->id) 
            ->latest() 
            ->take(5)  
            ->get();
        return view('postingan.detail-post', compact('post', 'beritaLainnya'));
    }
}