<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('children')
            ->whereNull('parent_id')
            ->orderBy('urutan')
            ->get();

        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::whereNull('parent_id')->get();
        return view('admin.menu.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
        ]);

        Menu::create([
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'nama_menu' => $request->nama_menu,
            'link_url' => $request->link_url,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->is_active ? 1 : 0,
        ]);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->get();

        return view('admin.menu.edit', compact('menu', 'parents'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required',
        ]);

        $menu->update([
            'parent_id' => $request->parent_id,
            'nama_menu' => $request->nama_menu,
            'link_url' => $request->link_url,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->is_active ? 1 : 0,
        ]);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil diupdate');
    }

    public function destroy(Menu $menu)
    {
        $menu->children()->delete();
        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus');
    }
}