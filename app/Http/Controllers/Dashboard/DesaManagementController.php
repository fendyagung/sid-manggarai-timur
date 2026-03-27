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
        $user = Auth::user();
        if (!in_array($user->role, ['admin_dpmd', 'admin_kecamatan'])) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin.');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $user = Auth::user();
        
        $query = Desa::with('admin')->orderBy('kecamatan')->orderBy('nama_desa');
        if ($user->role === 'admin_kecamatan') {
            $query->where('kecamatan', $user->kecamatan);
        }
        $desas = $query->paginate(30);
        
        return view('dashboard.dpmd.desa.index', compact('desas'));
    }

    public function create()
    {
        $this->checkAdmin();
        $user = Auth::user();
        if ($user->role === 'admin_kecamatan') {
            $kecamatans = Kecamatan::where('nama', $user->kecamatan)->get();
        } else {
            $kecamatans = Kecamatan::orderBy('nama')->get();
        }
        return view('dashboard.dpmd.desa.create', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $user = Auth::user();
        
        if ($user->role === 'admin_kecamatan' && $request->kecamatan !== $user->kecamatan) {
            abort(403, 'Anda hanya dapat menambahkan desa di kecamatan Anda.');
        }

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
        $user = Auth::user();
        $desa = Desa::findOrFail($id);
        
        if ($user->role === 'admin_kecamatan' && $desa->kecamatan !== $user->kecamatan) {
            abort(403, 'Anda tidak dapat mengedit desa di luar kecamatan Anda.');
        }

        if ($user->role === 'admin_kecamatan') {
            $kecamatans = Kecamatan::where('nama', $user->kecamatan)->get();
        } else {
            $kecamatans = Kecamatan::orderBy('nama')->get();
        }
        return view('dashboard.dpmd.desa.edit', compact('desa', 'kecamatans'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        $user = Auth::user();
        $desa = Desa::findOrFail($id);

        if ($user->role === 'admin_kecamatan') {
            if ($desa->kecamatan !== $user->kecamatan) {
                abort(403, 'Akses ditolak.');
            }
            if ($request->kecamatan !== $user->kecamatan) {
                abort(403, 'Akses ditolak memindahkan kecamatan.');
            }
        }

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
        $user = Auth::user();
        $desa = Desa::findOrFail($id);

        if ($user->role === 'admin_kecamatan' && $desa->kecamatan !== $user->kecamatan) {
            abort(403, 'Akses ditolak.');
        }

        if ($desa->user_id) {
            return back()->with('error', 'Tidak bisa menghapus desa yang sudah memiliki admin.');
        }

        $desa->delete();
        return redirect()->route('dashboard.dpmd.desa.index')->with('success', 'Desa berhasil dihapus!');
    }
}
