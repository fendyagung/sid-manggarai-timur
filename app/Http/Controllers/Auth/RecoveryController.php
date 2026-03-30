<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RecoveryController extends Controller
{
    public function showRecoveryForm()
    {
        return view('auth.recovery');
    }

    public function recover(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'recovery_code' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Attempt to find the user by email or username
        $user = User::where('email', $request->login)
                    ->orWhere('username', $request->login)
                    ->first();

        if (!$user || $user->role !== 'admin_dpmd') {
            return back()->withErrors(['login' => 'Akun Admin Dinas tidak ditemukan atau kredensial salah.']);
        }

        if (empty($user->recovery_codes)) {
            return back()->withErrors(['recovery_code' => 'Akun ini tidak memiliki Kode Pemulihan yang dikonfigurasi.']);
        }

        $codes = $user->recovery_codes;
        $codeIndex = array_search(strtoupper($request->recovery_code), $codes);

        if ($codeIndex === false) {
            return back()->withErrors(['recovery_code' => 'Kode Pemulihan tidak valid atau sudah digunakan.']);
        }

        // Remove the used code
        unset($codes[$codeIndex]);
        $user->recovery_codes = array_values($codes);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diperbarui. Silakan login kembali.');
    }
}
