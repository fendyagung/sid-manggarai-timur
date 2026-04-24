<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Laporan;
use App\Models\Arsip;
use App\Models\Regulasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BidangController extends Controller
{
    public function index(Request $request)
    {
        $bidang = $request->query('bidang', 'sekretariat');
        $validBidang = ['sekretariat', 'pemerintahan', 'pemberdayaan', 'ekonomi'];
        
        if (!in_array($bidang, $validBidang)) {
            return redirect()->route('dashboard')->with('warning', 'Bidang tidak valid.');
        }

        $kegiatans = Laporan::where('bidang', $bidang)
            ->whereNull('desa_id') // Internal reports don't have desa_id
            ->orderBy('created_at', 'desc')
            ->get();

        $arsips = Arsip::where('bidang', $bidang)
            ->orderBy('created_at', 'desc')
            ->get();

        $regulasis = Regulasi::where('bidang', $bidang)
            ->orderBy('created_at', 'desc')
            ->get();

        $title = "Dashboard - " . ucwords($bidang);
        if ($bidang === 'pemerintahan') $title = "Bidang (Pemerintahan Desa)";
        if ($bidang === 'pemberdayaan') $title = "Bidang (Pemberdayaan dan Lembaga Kemasyarakatan)";
        if ($bidang === 'ekonomi') $title = "Bidang (Penataan dan kerja sama)";

        return view('dashboard.bidang.index', compact('kegiatans', 'arsips', 'regulasis', 'bidang', 'title'));
    }

    public function storeKegiatan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'bidang' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        $filePath = null;
        $originalName = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('laporan_internal', 'public');
            $originalName = $request->file('file')->getClientOriginalName();
        }

        Laporan::create([
            'judul' => $request->judul,
            'kategori' => 'Kegiatan Internal',
            'bidang' => $request->bidang,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
            'original_name' => $originalName,
            'tanggal_laporan' => now(),
            'status' => 'diterima', // Internal is auto-approved
        ]);

        return back()->with('success', 'Laporan kegiatan berhasil disimpan.');
    }

    public function storeArsip(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'bidang' => 'required|string',
            'file' => 'required|file|max:20480',
            'keterangan' => 'nullable|string',
        ]);

        $filePath = $request->file('file')->store('arsip_bidang', 'public');
        $originalName = $request->file('file')->getClientOriginalName();

        Arsip::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'bidang' => $request->bidang,
            'file_path' => $filePath,
            'original_name' => $originalName,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Arsip berhasil disimpan.');
    }

    public function destroyKegiatan($id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->file_path) {
            Storage::disk('public')->delete($laporan->file_path);
        }
        $laporan->delete();

        return back()->with('success', 'Laporan kegiatan berhasil dihapus.');
    }

    public function destroyArsip($id)
    {
        $arsip = Arsip::findOrFail($id);
        if ($arsip->file_path) {
            Storage::disk('public')->delete($arsip->file_path);
        }
        $arsip->delete();

        return back()->with('success', 'Arsip berhasil dihapus.');
    }
}
