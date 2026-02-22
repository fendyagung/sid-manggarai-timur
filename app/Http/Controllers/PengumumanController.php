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
        ]);

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tipe' => $request->tipe,
            'is_active' => true,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil disiarkan!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->back()->with('success', 'Pengumuman dihapus.');
    }

    public function toggle(Pengumuman $pengumuman)
    {
        $pengumuman->update(['is_active' => !$pengumuman->is_active]);
        return redirect()->back()->with('success', 'Status pengumuman diperbarui.');
    }
}
