<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('dashboard.pengumuman.index', compact('pengumumans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tipe' => 'required|in:info,penting,darurat',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'lampiran' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $filePath = null;
        $originalName = null;
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filePath = $file->store('pengumuman-files', 'public');
            $originalName = $file->getClientOriginalName();
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengumuman-foto', 'public');
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tipe' => $request->tipe,
            'is_active' => true,
            'show_on_dashboard' => $request->has('show_on_dashboard'),
            'show_on_public' => $request->has('show_on_public'),
            'file_path' => $filePath,
            'original_name' => $originalName,
            'foto' => $fotoPath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Berita Utama berhasil disiarkan!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $pengumuman->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman dihapus.');
    }

    public function toggle(Pengumuman $pengumuman)
    {
        $pengumuman->update(['is_active' => !$pengumuman->is_active]);
        return redirect()->back()->with('success', 'Status pengumuman diperbarui.');
    }
}
