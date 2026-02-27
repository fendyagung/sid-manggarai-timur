<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request)
    {
        $role = $request->query('role', 'admin_desa');
        $dpmdAdminExists = User::where('role', 'admin_dpmd')->exists();
        $availableDesas = \App\Models\Desa::whereNull('user_id')->get();

        return view('auth.register', compact('dpmdAdminExists', 'availableDesas', 'role'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin_dpmd,admin_desa'],
            'desa_id' => ['required_if:role,admin_desa', 'nullable', 'exists:desas,id'],
        ]);

        // Prevent multiple Admin Dinas
        if ($request->role === 'admin_dpmd' && User::where('role', 'admin_dpmd')->exists()) {
            return back()->withErrors(['role' => 'Akun Admin Dinas sudah ada. Hanya diperbolehkan satu akun Admin Dinas.']);
        }



        // Double check for Desa Admin restriction
        if ($request->role === 'admin_desa') {
            $desa = \App\Models\Desa::find($request->desa_id);
            if ($desa->user_id) {
                return back()->withErrors(['desa_id' => 'Desa ini sudah memiliki admin.']);
            }
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Auto-set username based on role
        if ($request->role === 'admin_desa') {
            $desa = \App\Models\Desa::find($request->desa_id);
            if ($desa) {
                $userData['username'] = $desa->kode_desa;
            }
        } elseif ($request->role === 'admin_dpmd') {
            $userData['username'] = 'admin_dpmd';
        }

        $user = User::create($userData);

        // Link the user to the Desa if role is admin_desa
        if ($request->role === 'admin_desa' && $request->desa_id) {
            \App\Models\Desa::where('id', $request->desa_id)->update(['user_id' => $user->id]);
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
