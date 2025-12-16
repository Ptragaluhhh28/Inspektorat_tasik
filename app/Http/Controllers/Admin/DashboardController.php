<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kontak;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalBerita = Berita::count();
        $totalBeritaPublished = Berita::where('status', 1)->count();
        $totalGaleri = Galeri::count();
        $totalKontakMasuk = Kontak::where('status', 0)->count();

        // Berita terbaru
        $beritaTerbaru = Berita::latest()->take(5)->get();

        // Kontak masuk terbaru
        $kontakTerbaru = Kontak::latest()->take(5)->get();

        // Data untuk chart pengunjung (dummy data for now)
        $chartData = collect([
            ['tanggal' => '10/10', 'pengunjung' => 45, 'page_views' => 120],
            ['tanggal' => '11/10', 'pengunjung' => 52, 'page_views' => 145],
            ['tanggal' => '12/10', 'pengunjung' => 38, 'page_views' => 98],
            ['tanggal' => '13/10', 'pengunjung' => 61, 'page_views' => 167],
            ['tanggal' => '14/10', 'pengunjung' => 49, 'page_views' => 134],
            ['tanggal' => '15/10', 'pengunjung' => 57, 'page_views' => 156],
            ['tanggal' => '16/10', 'pengunjung' => 63, 'page_views' => 189]
        ]);

        // Total pengunjung bulan ini (dummy data)
        $totalPengunjungBulanIni = 1256;

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalBeritaPublished',
            'totalGaleri',
            'totalKontakMasuk',
            'beritaTerbaru',
            'kontakTerbaru',
            'chartData',
            'totalPengunjungBulanIni'
        ));
    }
}
