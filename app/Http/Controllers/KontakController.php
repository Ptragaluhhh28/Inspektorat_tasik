<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    /**
     * Store a new contact message
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ], [
            'nama.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'subjek.required' => 'Subjek harus dipilih',
            'pesan.required' => 'Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create new contact message
            $kontak = Kontak::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
                'status' => 0, // 0 = unread/baru, 1 = read/dibaca
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda telah berhasil dikirim! Kami akan segera menghubungi Anda.',
                'data' => $kontak
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
