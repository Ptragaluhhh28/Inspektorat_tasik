<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::latest()->paginate(20);
        return view('admin.kontak.index', compact('kontak'));
    }

    public function show(Kontak $kontak)
    {
        // Mark as read
        if (!$kontak->status) {
            $kontak->update(['status' => 1]);
        }
        
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Pesan kontak berhasil dihapus.');
    }

    public function markAsRead(Kontak $kontak)
    {
        $kontak->update(['status' => 1]);

        return redirect()->back()
            ->with('success', 'Pesan ditandai sebagai sudah dibaca.');
    }

    public function markAsUnread(Kontak $kontak)
    {
        $kontak->update(['status' => 0]);

        return redirect()->back()
            ->with('success', 'Pesan ditandai sebagai belum dibaca.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('selected_ids', []);
        
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada pesan yang dipilih.');
        }

        Kontak::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', count($ids) . ' pesan berhasil dihapus.');
    }

    public function bulkMarkAsRead(Request $request)
    {
        $ids = $request->input('selected_ids', []);
        
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada pesan yang dipilih.');
        }

        Kontak::whereIn('id', $ids)->update(['status' => 1]);

        return redirect()->back()
            ->with('success', count($ids) . ' pesan ditandai sebagai sudah dibaca.');
    }
}
