<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        // Ambil berita yang sudah dipublish saja
        $berita = Berita::published() // status = 1
                       ->latest()
                       ->paginate(9); // 9 item per halaman untuk grid 3x3
        
        return view('berita.index', compact('berita'));
    }

    public function show($slug)
    {
        // Cari berita berdasarkan slug dan pastikan sudah dipublish
        $berita = Berita::where('slug', $slug)
                       ->where('status', 1)
                       ->firstOrFail();
        
        // Increment views
        $berita->increment('views');
        
        return view('berita.detail', compact('berita'));
    }
}