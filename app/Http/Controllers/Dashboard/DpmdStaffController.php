<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DpmdStaff;
use App\Models\DpmdProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DpmdStaffController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $profile = DpmdProfile::first();
        if (!$profile) {
            $profile = DpmdProfile::create(['nama_instansi' => 'DPMD Manggarai Timur']);
        }

        $data = $request->only(['nama', 'jabatan', 'urutan']);
        $data['dpmd_profile_id'] = $profile->id;

        if (!$request->urutan) {
            $data['urutan'] = DpmdStaff::count() + 1;
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dpmd/staff', 'public');
        }

        DpmdStaff::create($data);

        return redirect()->back()->with('success', 'Staf berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $staff = DpmdStaff::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan', 'urutan']);

        if ($request->hasFile('foto')) {
            if ($staff->foto) {
                Storage::disk('public')->delete($staff->foto);
            }
            $data['foto'] = $request->file('foto')->store('dpmd/staff', 'public');
        }

        $staff->update($data);

        return redirect()->back()->with('success', 'Informasi staf diperbarui!');
    }

    public function destroy($id)
    {
        $staff = DpmdStaff::findOrFail($id);
        if ($staff->foto) {
            Storage::disk('public')->delete($staff->foto);
        }
        $staff->delete();

        return redirect()->back()->with('success', 'Staf berhasil dihapus.');
    }
}
