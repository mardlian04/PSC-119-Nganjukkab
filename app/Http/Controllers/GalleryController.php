<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function publicGallery()
    {
        $galleries = \App\Models\Gallery::latest()->paginate(8);
        return view('galeri.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png',
            'deskripsi' => 'nullable|string'
        ]);

        $path = $request->file('gambar')->store('gallery', 'public');

        Gallery::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'gambar' => $path,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('gallery.index')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'deskripsi' => 'nullable|string'
        ]);

        if ($request->hasFile('gambar')) {
            if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
                Storage::disk('public')->delete($gallery->gambar);
            }

            $path = $request->file('gambar')->store('gallery', 'public');
        } else {
            $path = $gallery->gambar;
        }

        $gallery->update([
            'judul' => $request->judul,
            'gambar' => $path,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('gallery.index')->with('success', 'Galeri berhasil diupdate');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
            Storage::disk('public')->delete($gallery->gambar);
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Galeri berhasil dihapus');
    }
}