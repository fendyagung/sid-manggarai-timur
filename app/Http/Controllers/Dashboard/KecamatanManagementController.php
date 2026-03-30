<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KecamatanManagementController extends Controller
{
    private function checkAdmin()
    {
        if (Auth::user()->role !== 'admin_dpmd') {
            abort(403, 'Hanya Admin DPMD yang dapat mengelola data Kecamatan.');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $kecamatans = Kecamatan::withCount('desas')->orderBy('nama')->get();
        
        // Add admin info to each kecamatan
        foreach ($kecamatans as $kec) {
            $kec->admin = User::where('role', 'admin_kecamatan')
                ->where('kecamatan', $kec->nama)
                ->first();
        }

        return view('dashboard.dpmd.kecamatan.index', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'nama' => 'required|string|max:255|unique:kecamatans,nama',
        ]);

        Kecamatan::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('dashboard.dpmd.kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        $kecamatan = Kecamatan::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255|unique:kecamatans,nama,' . $id,
        ]);

        // If name changes, we might need to update existing desas if they store name as string
        // In this project, desas table has a 'kecamatan' string column
        $oldName = $kecamatan->nama;
        $newName = $request->nama;

        if ($oldName !== $newName) {
            Desa::where('kecamatan', $oldName)->update(['kecamatan' => $newName]);
        }

        $kecamatan->update([
            'nama' => $newName
        ]);

        return redirect()->route('dashboard.dpmd.kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->checkAdmin();
        $kecamatan = Kecamatan::findOrFail($id);

        // Check if there are desas in this kecamatan
        if (Desa::where('kecamatan', $kecamatan->nama)->exists()) {
            return back()->with('error', 'Tidak bisa menghapus kecamatan yang masih memiliki desa terdaftar.');
        }

        $kecamatan->delete();
        return redirect()->route('dashboard.dpmd.kecamatan.index')->with('success', 'Kecamatan berhasil dihapus!');
    }

    public function resetPassword(Request $request, $id)
    {
        $this->checkAdmin();
        $kecamatan = Kecamatan::findOrFail($id);
        
        $admin = User::where('role', 'admin_kecamatan')
            ->where('kecamatan', $kecamatan->nama)
            ->first();

        if (!$admin) {
            return back()->with('error', 'Kecamatan ini belum memiliki admin.');
        }

        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $admin->password = Hash::make($request->password);
        $admin->save();

        return back()->with('success', "Kata sandi untuk admin kecamatan {$kecamatan->nama} ({$admin->name}) berhasil diperbarui.");
    }
}
