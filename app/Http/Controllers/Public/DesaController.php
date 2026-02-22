<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesaController extends Controller
{
    public function desaWisata(Request $request)
    {
        $query = \App\Models\Desa::with('potensis')->where('is_desa_wisata', true);

        if ($request->has('jenis') && in_array($request->jenis, ['desa', 'kelurahan'])) {
            $query->where('jenis', $request->jenis);
        }

        $desas = $query->latest()->paginate(9);
        return view('public.desa-wisata', compact('desas'));
    }

    public function showProfil($id)
    {
        $desa = \App\Models\Desa::with('potensis')->findOrFail($id);
        return view('public.desa-profil', compact('desa'));
    }

    public function kuliner()
    {
        $potensis = \App\Models\Potensi::with('desa')->where('kategori', 'kuliner')->latest()->get();
        return view('public.kuliner', compact('potensis'));
    }

    public function komoditi()
    {
        $potensis = \App\Models\Potensi::with('desa')->where('kategori', 'komoditi')->latest()->get();
        return view('public.komoditi', compact('potensis'));
    }

    public function kerajinan()
    {
        $potensis = \App\Models\Potensi::with('desa')->where('kategori', 'kerajinan')->latest()->get();
        return view('public.kerajinan', compact('potensis'));
    }

    public function event()
    {
        $potensis = \App\Models\Potensi::with('desa')->where('kategori', 'event')->latest()->get();
        return view('public.event', compact('potensis'));
    }

    public function panduan()
    {
        return view('public.panduan');
    }

    public function kontak()
    {
        $profile = \App\Models\DpmdProfile::first();
        return view('public.kontak', compact('profile'));
    }

    public function potensiWisata()
    {
        return view('public.potensi-wisata');
    }

    public function berita()
    {
        return view('public.berita');
    }

    public function showBerita($slug)
    {
        $berita = \App\Models\Berita::where('slug', $slug)->firstOrFail();
        return view('public.berita-show', compact('berita'));
    }

    public function profil()
    {
        $profile = \App\Models\DpmdProfile::first();
        return view('public.profil', compact('profile'));
    }

    public function submitKontak(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $data['lampiran'] = $file->store('pesans-lampiran', 'public');
            $data['original_name'] = $file->getClientOriginalName();
        }

        \App\Models\Pesan::create($data);

        return back()->with('success', 'Pesan Anda telah berhasil dikirim ke Dinas PMD. Terima kasih!');
    }

    public function laporanDesa()
    {
        $dpmdProfile = \App\Models\DpmdProfile::first();

        // Stats for Charts
        $reportsByStatus = \App\Models\Laporan::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $reportsByCategory = \App\Models\Laporan::selectRaw('kategori, count(*) as count')
            ->where('status', 'diterima') // Focus public view on accepted/verified reports usually
            ->groupBy('kategori')
            ->pluck('count', 'kategori')
            ->toArray();

        // New Real-time Stats
        $totalReports = \App\Models\Laporan::count();
        $totalAccepted = \App\Models\Laporan::where('status', 'diterima')->count();
        $validityRate = $totalReports > 0 ? round(($totalAccepted / $totalReports) * 100) : 0;

        // Last Update Tracking
        $latestReport = \App\Models\Laporan::latest()->first();
        $lastUpdate = $latestReport ? $latestReport->created_at->diffForHumans() : 'Belum ada data';

        return view('public.laporan', compact('dpmdProfile', 'reportsByStatus', 'reportsByCategory', 'totalReports', 'validityRate', 'lastUpdate'));
    }



    public function videoGallery()
    {
        $dpmdProfile = \App\Models\DpmdProfile::first();
        $villages = \App\Models\Desa::whereNotNull('video_youtube')->latest()->get();
        return view('public.video-gallery', compact('dpmdProfile', 'villages'));
    }
}
