<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeraturanController extends Controller
{
    public function index()
    {
        $peraturan = Peraturan::latest()->paginate(10);
        return view('admin.peraturan.index', compact('peraturan'));
    }

    public function create()
    {
        return view('admin.peraturan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'kategori' => 'nullable|string|max:100',
            'nomor_peraturan' => 'nullable|string|max:100',
            'tanggal_terbit' => 'nullable|date',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/peraturan', $filename);
            $data['file_path'] = $filename;
        }

        Peraturan::create($data);

        return redirect()->route('admin.peraturan.index')
            ->with('success', 'Peraturan berhasil ditambahkan.');
    }

    public function show(Peraturan $peraturan)
    {
        return view('admin.peraturan.show', compact('peraturan'));
    }

    public function edit(Peraturan $peraturan)
    {
        return view('admin.peraturan.edit', compact('peraturan'));
    }

    public function update(Request $request, Peraturan $peraturan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'kategori' => 'nullable|string|max:100',
            'nomor_peraturan' => 'nullable|string|max:100',
            'tanggal_terbit' => 'nullable|date',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file_path')) {
            // Delete old file
            if ($peraturan->file_path) {
                Storage::delete('public/peraturan/' . $peraturan->file_path);
            }

            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/peraturan', $filename);
            $data['file_path'] = $filename;
        }

        $peraturan->update($data);

        return redirect()->route('admin.peraturan.index')
            ->with('success', 'Peraturan berhasil diperbarui.');
    }

    public function destroy(Peraturan $peraturan)
    {
        // Delete file
        if ($peraturan->file_path) {
            Storage::delete('public/peraturan/' . $peraturan->file_path);
        }

        $peraturan->delete();

        return redirect()->route('admin.peraturan.index')
            ->with('success', 'Peraturan berhasil dihapus.');
    }

    public function download(Peraturan $peraturan)
    {
        $filePath = storage_path('app/public/peraturan/' . $peraturan->file_path);
        
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
