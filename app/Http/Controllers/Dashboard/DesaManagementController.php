<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesaManagementController extends Controller
{
    private function checkAdmin()
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403, 'Hanya Admin DPMD yang bisa mengakses menu ini.');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $desas = Desa::with('admin')->latest()->paginate(15);
        return view('dashboard.dpmd.desa.index', compact('desas'));
    }

    public function create()
    {
        $this->checkAdmin();
        $kecamatans = Kecamatan::orderBy('nama')->get();
        return view('dashboard.dpmd.desa.create', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'jenis' => 'required|in:desa,kelurahan',
            'kode_desa' => 'nullable|string|max:20|unique:desas,kode_desa',
            'kecamatan' => 'required|string|max:255',
        ]);

        Desa::create([
            'nama_desa' => $request->nama_desa,
            'jenis' => $request->jenis ?? 'desa',
            'kode_desa' => $request->kode_desa,
            'kecamatan' => $request->kecamatan,
        ]);

        return redirect()->route('dashboard.dpmd.desa.index')->with('success', 'Desa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $this->checkAdmin();
        $desa = Desa::findOrFail($id);
        $kecamatans = Kecamatan::orderBy('nama')->get();
        return view('dashboard.dpmd.desa.edit', compact('desa', 'kecamatans'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        $desa = Desa::findOrFail($id);

        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'jenis' => 'required|in:desa,kelurahan',
            'kode_desa' => 'nullable|string|max:20|unique:desas,kode_desa,' . $id,
            'kecamatan' => 'required|string|max:255',
        ]);

        $desa->update([
            'nama_desa' => $request->nama_desa,
            'jenis' => $request->jenis ?? 'desa',
            'kode_desa' => $request->kode_desa,
            'kecamatan' => $request->kecamatan,
        ]);

        return redirect()->route('dashboard.dpmd.desa.index')->with('success', 'Data desa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->checkAdmin();
        $desa = Desa::findOrFail($id);

        if ($desa->user_id) {
            return back()->with('error', 'Tidak bisa menghapus desa yang sudah memiliki admin.');
        }

        $desa->delete();
        return redirect()->route('dashboard.dpmd.desa.index')->with('success', 'Desa berhasil dihapus!');
    }
}
