<?php

namespace App\Http\Controllers;

use App\Models\Regulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RegulasiController extends Controller
{
    /**
     * Display a listing of the resource (Admin View).
     */
    public function index()
    {
        $regulasis = Regulasi::latest()->paginate(10);
        return view('dashboard.regulasi.index', compact('regulasis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:Format Laporan,Peraturan Daerah,Template Surat,Materi Sosialisasi,Lainnya',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240', // Max 10MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('regulasi', 'public');
        $originalName = $file->getClientOriginalName();

        Regulasi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'original_name' => $originalName,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard.regulasi.index')->with('success', 'Dokumen berhasil diunggah!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regulasi $regulasi)
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        return view('dashboard.regulasi.edit', compact('regulasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regulasi $regulasi)
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:Format Laporan,Peraturan Daerah,Template Surat,Materi Sosialisasi,Lainnya',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
        ]);

        $data = $request->only(['judul', 'kategori', 'deskripsi']);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($regulasi->file_path && Storage::disk('public')->exists($regulasi->file_path)) {
                Storage::disk('public')->delete($regulasi->file_path);
            }
            $file = $request->file('file');
            $data['file_path'] = $file->store('regulasi', 'public');
            $data['original_name'] = $file->getClientOriginalName();
        }

        $regulasi->update($data);

        return redirect()->route('dashboard.regulasi.index')->with('success', 'Dokumen berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regulasi $regulasi)
    {
        if ($regulasi->file_path && Storage::disk('public')->exists($regulasi->file_path)) {
            Storage::disk('public')->delete($regulasi->file_path);
        }

        $regulasi->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Display a listing of the resource (Public/User View).
     */
    public function publicIndex()
    {
        $regulasis = Regulasi::latest()->get()->groupBy('kategori');
        return view('public.bank-data', compact('regulasis'));
    }

    /**
     * Download the specified resource and mark as read.
     */
    public function download(Regulasi $regulasi)
    {
        // Record download if authenticated
        if (Auth::check()) {
            \App\Models\RegulasiDownload::firstOrCreate([
                'regulasi_id' => $regulasi->id,
                'user_id' => Auth::id(),
            ]);
        }

        if (!$regulasi->file_path || !Storage::disk('public')->exists($regulasi->file_path)) {
            return redirect()->back()->with('warning', 'File tidak ditemukan.');
        }

        $downloadName = $regulasi->original_name ?? ($regulasi->judul . '.' . pathinfo($regulasi->file_path, PATHINFO_EXTENSION));

        return Storage::disk('public')->download($regulasi->file_path, $downloadName);
    }
}
