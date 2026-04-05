<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Visitor;
use App\Models\Page;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $waktuSekarang = Carbon::now('Asia/Jakarta');

        $data = [
            'totalPosts'     => Post::count(),
            'totalGalleries' => Gallery::count(),
            'totalPages' => Page::count(),
            'latestPosts'    => Post::latest()->take(5)->get(),
            'totalVisitor' => Visitor::count(),
            'todayVisitor' => Visitor::whereDate('visit_date', today())->count(),
            'uniqueVisitor' => Visitor::distinct('ip_address')->count(),
            'serverTime'     => $waktuSekarang->format('H:i:s'),
            'serverDate'     => $waktuSekarang->translatedFormat('l, d F Y'),
            'sapaanServer'   => $this->getSapaan($waktuSekarang->hour),
        ];

        return view('dashboard', $data);
    }

    private function getSapaan($hour)
    {
        if ($hour >= 5 && $hour < 11) return "Selamat Pagi";
        if ($hour >= 11 && $hour < 15) return "Selamat Siang";
        if ($hour >= 15 && $hour < 18) return "Selamat Sore";
        return "Selamat Malam";
    }
}