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
        if (is_string($ids)) {
            $ids = json_decode($ids, true);
        }
        
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
        if (is_string($ids)) {
            $ids = json_decode($ids, true);
        }
        
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada pesan yang dipilih.');
        }

        Kontak::whereIn('id', $ids)->update(['status' => 1]);

        return redirect()->back()
            ->with('success', count($ids) . ' pesan ditandai sebagai sudah dibaca.');
    }

    public function reply(Request $request, Kontak $kontak)
    {
        $request->validate([
            'balasan' => 'required|string'
        ]);

        // Mark as read when replying
        $kontak->update([
            'status' => 1,
            'balasan' => $request->balasan,
            'replied_at' => now()
        ]);

        // Sanitize phone number for WhatsApp (remove non-digits and leading 0/+)
        $phone = preg_replace('/[^0-9]/', '', $kontak->telepon);
        if (strpos($phone, '0') === 0) {
            $phone = '62' . substr($phone, 1);
        } elseif (strpos($phone, '62') !== 0) {
            $phone = '62' . $phone;
        }

        // WhatsApp message format
        $message = "Halo " . $kontak->nama . ",\n\n";
        $message .= "Kami dari Inspektorat Kota Tasikmalaya menanggapi pengaduan Anda mengenai: " . $kontak->subjek . ".\n\n";
        $message .= "Jawaban: " . $request->balasan . "\n\n";
        $message .= "Terima kasih.";
        
        $waUrl = "https://wa.me/" . $phone . "?text=" . urlencode($message);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Balasan berhasil disimpan!',
                'wa_url' => $waUrl
            ]);
        }

        return redirect()->back()
            ->with('success', 'Balasan berhasil disimpan.')
            ->with('wa_url', $waUrl);
    }
}
