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

        // Data untuk chart pengunjung (real data for 7 days)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = \App\Models\Visitor::whereDate('visited_at', $date)->count();
            
            $chartData[] = [
                'tanggal' => $date->format('d/m'),
                'pengunjung' => $count
            ];
        }
        $chartData = collect($chartData);

        // Total pengunjung bulan ini (real data - total hits)
        $totalPengunjungBulanIni = \App\Models\Visitor::whereMonth('visited_at', now()->month)
            ->whereYear('visited_at', now()->year)
            ->count();

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
