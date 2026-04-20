<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function publicIndex(Request $request)
    {
        $posts = \App\Models\Post::where('status', 'publish')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('isi_konten', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('postingan.index', compact('posts'));
    }
    
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|unique:posts,slug',
            'kategori' => 'required',
            'isi_konten' => 'required',
            'gambar_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,publish',
        ]);

        $slug = $request->slug ?? Str::slug($request->judul);

        $path = null;
        if ($request->hasFile('gambar_thumbnail')) {
            $path = $request->file('gambar_thumbnail')->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'slug' => $slug,
            'kategori' => $request->kategori,
            'isi_konten' => $request->isi_konten,
            'gambar_thumbnail' => $path,
            'status' => $request->status,
            'jumlah_view' => 0,
        ]);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil ditambahkan');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|unique:posts,slug,' . $post->id,
            'kategori' => 'required',
            'isi_konten' => 'required',
            'gambar_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,publish',
        ]);

        $slug = $request->slug ?? Str::slug($request->judul);

        $data = [
            'judul' => $request->judul,
            'slug' => $slug,
            'kategori' => $request->kategori,
            'isi_konten' => $request->isi_konten,
            'status' => $request->status,
        ];

        if ($request->hasFile('gambar_thumbnail')) {

            if ($post->gambar_thumbnail) {
                Storage::disk('public')->delete($post->gambar_thumbnail);
            }

            $data['gambar_thumbnail'] = $request->file('gambar_thumbnail')
                ->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil diupdate');
    }

    public function destroy(Post $post)
    {
        if ($post->gambar_thumbnail) {
            Storage::disk('public')->delete($post->gambar_thumbnail);
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dihapus');
    }
}