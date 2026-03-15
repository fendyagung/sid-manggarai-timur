<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $loginField = $request->input('login');
        $loginType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        $authCredentials = [
            $loginType => $loginField,
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($authCredentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Validate requested role against actual user role
            $requestedRole = $request->input('role'); // 'desa', 'admin_kecamatan', or 'dmpd'
            $actualRole = $user->role; // 'admin_desa', 'admin_kecamatan', or 'admin_dpmd'

            $isDesaMismatch = ($requestedRole === 'desa' && $actualRole !== 'admin_desa');
            $isKecamatanMismatch = ($requestedRole === 'admin_kecamatan' && $actualRole !== 'admin_kecamatan');
            $isDmpdMismatch = ($requestedRole === 'dmpd' && $actualRole !== 'admin_dpmd');

            if ($isDesaMismatch || $isKecamatanMismatch || $isDmpdMismatch) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $targetLabel = 'Admin Dinas';
                if ($requestedRole === 'desa') $targetLabel = 'Admin Desa';
                if ($requestedRole === 'admin_kecamatan') $targetLabel = 'Admin Kecamatan';
                
                return back()->withErrors([
                    'login' => "Maaf, akun Anda tidak terdaftar sebagai $targetLabel. Silakan login pada tab yang sesuai.",
                ])->onlyInput('login', 'role');
            }

            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'login' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('login');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
