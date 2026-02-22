<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin_dpmd') {
            $beritas = Berita::with('user')->latest()->paginate(10);
        } else {
            $beritas = Berita::where('user_id', $user->id)->latest()->paginate(10);
        }
        return view('dashboard.beritas.index', compact('beritas'));
    }

    public function create()
    {
        return view('dashboard.beritas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|max:5120',
            'kategori' => 'required|string',
            'is_published' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('dashboard.beritas.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);

        // Check ownership or admin_dpmd role
        if (Auth::id() !== $berita->user_id && Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        return view('dashboard.beritas.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        if (Auth::id() !== $berita->user_id && Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|max:5120',
            'kategori' => 'required|string',
            'is_published' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($berita->foto) {
                Storage::delete('public/' . $berita->foto);
            }
            $data['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('dashboard.beritas.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if (Auth::id() !== $berita->user_id && Auth::user()->role !== 'admin_dpmd') {
            abort(403);
        }

        if ($berita->foto) {
            Storage::delete('public/' . $berita->foto);
        }

        $berita->delete();

        return redirect()->route('dashboard.beritas.index')->with('success', 'Berita telah dihapus.');
    }
}