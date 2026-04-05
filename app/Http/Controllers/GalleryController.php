<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(6);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function publicIndex()
    {
        $galleries = \App\Models\Gallery::latest()->paginate(12);
        return view('galeri.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_file' => 'required',
            'tipe_file' => 'required|in:image,pdf',
            'path_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $file = $request->file('path_file')->store('galleries', 'public');

        Gallery::create([
            'user_id' => Auth::id(),
            'judul_file' => $request->judul_file,
            'slug' => Str::slug($request->judul_file),
            'tipe_file' => $request->tipe_file,
            'path_file' => $file,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery berhasil ditambahkan');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'judul_file' => 'required|string|max:255',
            'tipe_file'  => 'required|in:image,pdf',
            'path_file'  => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $file = $gallery->path_file;

        if ($request->hasFile('path_file')) {
            if ($gallery->path_file) {
                Storage::disk('public')->delete($gallery->path_file);
            }
            
            $file = $request->file('path_file')->store('galleries', 'public');
        }

        $gallery->update([
            'judul_file' => $request->judul_file,
            'slug'       => Str::slug($request->judul_file) . '-' . time(), 
            'tipe_file'  => $request->tipe_file,
            'path_file'  => $file,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery berhasil diupdate');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->path_file);
        $gallery->delete();
        return back()->with('success', 'Gallery dihapus');
    }
}