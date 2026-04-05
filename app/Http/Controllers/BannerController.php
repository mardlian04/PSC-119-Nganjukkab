<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function welcome()
    {
       $banner = Banner::latest()->first();
       return view('welcome', compact('banner'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teks' => 'required',
            'sub_teks' => 'nullable',
            'path_gambar' => 'required|image|mimes:webp,jpg,jpeg,png'
        ]);

        $path = null;
        if ($request->hasFile('path_gambar')) {
            $path = $request->file('path_gambar')->store('banners', 'public');
        }

        Banner::create([
            'user_id' => Auth::id(),
            'teks' => $request->teks,
            'sub_teks' => $request->sub_teks,
            'path_gambar' => $path
        ]);

        return redirect()->route('banners.index')
            ->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'teks' => 'required',
            'sub_teks' => 'nullable',
            'path_gambar' => 'nullable|image|mimes:webp,jpg,jpeg,png'
        ]);

        $data = [
            'teks' => $request->teks,
            'sub_teks' => $request->sub_teks,
        ];

        if ($request->hasFile('path_gambar')) {

            if ($banner->path_gambar) {
                Storage::disk('public')->delete($banner->path_gambar);
            }

            $data['path_gambar'] = $request->file('path_gambar')
                ->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('banners.index')
            ->with('success', 'Banner berhasil diupdate');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->path_gambar) {
            Storage::disk('public')->delete($banner->path_gambar);
        }

        $banner->delete();

        return redirect()->route('banners.index')
            ->with('success', 'Banner berhasil dihapus');
    }
}