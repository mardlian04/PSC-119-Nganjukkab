<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        try {
            $media = Media::latest()->paginate(6);
            return view('admin.media.index', compact('media'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengambil data media');
        }
    }

    public function publicMedia()
    {
        try {
            $media = Media::latest()->paginate(12);
            return view('media.index', compact('media'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menampilkan media');
        }
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul_file'    => 'required|string|max:255',
                'kategori'      => 'required|in:media_cetak,media_publikasi,infografis',
                'tipe_file'     => 'required|in:image,pdf',
                'path_file'     => [
                    'required',
                    'file',
                    $request->tipe_file === 'image'
                        ? 'mimes:jpg,jpeg,png'
                        : 'mimes:pdf',
                    'max:5120'
                ],
                'sampul_gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'keterangan'    => 'nullable|string'
            ]);

            $file = $request->file('path_file')->store('media', 'public');

            $sampul = null;
            if ($request->hasFile('sampul_gambar')) {
                $sampul = $request->file('sampul_gambar')->store('media/sampul', 'public');
            }

            Media::create([
                'user_id'       => Auth::id(),
                'judul_file'    => $request->judul_file,
                'kategori'      => $request->kategori,
                'slug'          => Str::slug($request->judul_file) . '-' . Str::random(5),
                'sampul_gambar' => $sampul,
                'tipe_file'     => $request->tipe_file,
                'path_file'     => $file,
                'keterangan'    => $request->keterangan
            ]);

            return redirect()->route('media.index')->with('success', 'Media berhasil ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        try {
            $request->validate([
                'judul_file'    => 'required|string|max:255',
                'kategori'      => 'required|in:media_cetak,media_publikasi,infografis',
                'tipe_file'     => 'required|in:image,pdf',
                'path_file'     => [
                    'nullable',
                    'file',
                    $request->tipe_file === 'image'
                        ? 'mimes:jpg,jpeg,png'
                        : 'mimes:pdf',
                    'max:5120'
                ],
                'sampul_gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'keterangan'    => 'nullable|string'
            ]);

            $file = $media->path_file;
            if ($request->hasFile('path_file')) {
                if ($media->path_file) {
                    Storage::disk('public')->delete($media->path_file);
                }
                $file = $request->file('path_file')->store('media', 'public');
            }

            $sampul = $media->sampul_gambar;
            if ($request->hasFile('sampul_gambar')) {
                if ($media->sampul_gambar) {
                    Storage::disk('public')->delete($media->sampul_gambar);
                }
                $sampul = $request->file('sampul_gambar')->store('media/sampul', 'public');
            }

            $media->update([
                'judul_file'    => $request->judul_file,
                'kategori'      => $request->kategori,
                'slug'          => $media->slug,
                'sampul_gambar' => $sampul,
                'tipe_file'     => $request->tipe_file,
                'path_file'     => $file,
                'keterangan'    => $request->keterangan
            ]);

            return redirect()->route('media.index')->with('success', 'Media berhasil diupdate');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update media');
        }
    }

    public function destroy(Media $media)
    {
        try {
            if ($media->path_file) {
                Storage::disk('public')->delete($media->path_file);
            }

            if ($media->sampul_gambar) {
                Storage::disk('public')->delete($media->sampul_gambar);
            }

            $media->delete();

            return back()->with('success', 'Media berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus media');
        }
    }
}