<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Banner;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'publish')
            ->latest()
            ->paginate(6);
        $banner = Banner::latest()->first();

        return view('welcome', compact('posts', 'banner'));
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

    public function pageDetail($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if ($page) {
            return view('halaman.index', compact('page'));
        }
    }
}