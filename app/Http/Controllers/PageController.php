<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_halaman' => 'required',
            'isi_konten' => 'required',
        ]);

        $slug = Str::slug($request->judul_halaman);

        $count = Page::where('slug', 'LIKE', "$slug%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $gambar = null;

        if ($request->hasFile('gambar_fitur')) {
            $gambar = $request->file('gambar_fitur')->store('pages', 'public');
        }

        Page::create([
            'user_id' => Auth::id(),
            'judul_halaman' => $request->judul_halaman,
            'slug' => $slug,
            'isi_konten' => $request->isi_konten,
            'gambar_fitur' => $gambar,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('pages.index')
            ->with('success', 'Halaman berhasil dibuat');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'judul_halaman' => 'required',
            'isi_konten' => 'required',
        ]);

        $slug = Str::slug($request->judul_halaman);

        if ($slug != $page->slug) {
            $count = Page::where('slug', 'LIKE', "$slug%")
                ->where('id', '!=', $page->id)
                ->count();

            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
        }

        $gambar = $page->gambar_fitur;

        if ($request->hasFile('gambar_fitur')) {
            $gambar = $request->file('gambar_fitur')->store('pages', 'public');
        }

        $page->update([
            'judul_halaman' => $request->judul_halaman,
            'slug' => $slug,
            'isi_konten' => $request->isi_konten,
            'gambar_fitur' => $gambar,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('pages.index')
            ->with('success', 'Halaman berhasil diupdate');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return back()->with('success', 'Halaman berhasil dihapus');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('upload')->store('ckeditor', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }
}