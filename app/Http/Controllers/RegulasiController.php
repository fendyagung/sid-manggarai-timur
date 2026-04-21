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
    public function index(Request $request)
    {
        $query = Regulasi::latest();
        $user = Auth::user();

        if ($user->role === 'admin_dpmd') {
            // Admin DPMD sees everything and can filter by bidang
            if ($request->has('bidang') && $request->bidang != '') {
                $query->where('bidang', $request->bidang);
            }
        } elseif ($user->role === 'admin_kecamatan') {
            // Admin Kecamatan sees everything that is "Public" (bidang null)
            // OR documents they uploaded themselves (regardless of bidang)
            $query->where(function ($q) use ($user) {
                $q->whereNull('bidang')
                    ->orWhere('user_id', $user->id);
            });
        } elseif ($user->role === 'admin_desa') {
            // Admin Desa sees "Public" (bidang null) documents that are:
            // 1. Sent by DPMD
            // 2. Sent by THEIR OWN Kecamatan
            $desaKecamatan = $user->desa ? $user->desa->kecamatan : $user->kecamatan;

            $query->whereNull('bidang')
                ->where(function ($q) use ($desaKecamatan) {
                    $q->whereHas('user', function ($inner) {
                        $inner->where('role', 'admin_dpmd');
                    })->orWhereHas('user', function ($inner) use ($desaKecamatan) {
                        $inner->where('role', 'admin_kecamatan')
                            ->where('kecamatan', $desaKecamatan);
                    });
                });
        }

        $regulasis = $query->paginate(10);
        return view('dashboard.regulasi.index', compact('regulasis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:Format Laporan,Peraturan Daerah,Template Surat,Materi Sosialisasi,Dokumen Penting,Lainnya',
            'bidang' => 'nullable|string|in:sekretariat,pemerintahan,pemberdayaan,ekonomi',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240', // Max 10MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('regulasi', 'public');
        $originalName = $file->getClientOriginalName();

        Regulasi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'bidang' => $request->bidang,
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
        if (!in_array(Auth::user()->role, ['admin_dpmd', 'admin_kecamatan'])) {
            abort(403);
        }

        // Admin Kecamatan can only edit their own
        if (Auth::user()->role === 'admin_kecamatan' && $regulasi->user_id !== Auth::id()) {
            abort(403);
        }

        return view('dashboard.regulasi.edit', compact('regulasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regulasi $regulasi)
    {
        if (!in_array(Auth::user()->role, ['admin_dpmd', 'admin_kecamatan'])) {
            abort(403);
        }

        // Admin Kecamatan can only update their own
        if (Auth::user()->role === 'admin_kecamatan' && $regulasi->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:Format Laporan,Peraturan Daerah,Template Surat,Materi Sosialisasi,Dokumen Penting,Lainnya',
            'bidang' => 'nullable|string|in:sekretariat,pemerintahan,pemberdayaan,ekonomi',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
        ]);

        $data = $request->only(['judul', 'kategori', 'bidang', 'deskripsi']);

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
        if (!in_array(Auth::user()->role, ['admin_dpmd', 'admin_kecamatan'])) {
            abort(403);
        }

        // Admin Kecamatan can only delete their own
        if (Auth::user()->role === 'admin_kecamatan' && $regulasi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($regulasi->file_path && file_exists(storage_path('app/public/' . $regulasi->file_path))) {
            unlink(storage_path('app/public/' . $regulasi->file_path));
        }

        $regulasi->delete();

        return redirect()->route('dashboard.regulasi.index')->with('success', 'Dokumen berhasil dihapus.');
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

        $fullPath = storage_path('app/public/' . $regulasi->file_path);
        if (!$regulasi->file_path || !file_exists($fullPath)) {
            return back()->with('warning', 'File tidak ditemukan.');
        }

        $downloadName = $regulasi->original_name ?? ($regulasi->judul . '.' . pathinfo($regulasi->file_path, PATHINFO_EXTENSION));

        return response()->download($fullPath, $downloadName);
    }
}
