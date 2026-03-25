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
        ]);

        $data = $request->only(['nama', 'jabatan', 'urutan']);

        $staff->update($data);

        return redirect()->back()->with('success', 'Informasi staf diperbarui!');
    }

    public function destroy($id)
    {
        $staff = DpmdStaff::findOrFail($id);
        $staff->delete();

        return redirect()->back()->with('success', 'Staf berhasil dihapus.');
    }
}
