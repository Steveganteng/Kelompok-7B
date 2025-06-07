<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Arahkan berdasarkan role
            if ($user->role === 'apoteker') {
                return redirect('/apoteker/dashboard');
            } elseif ($user->role === 'dokter') {
                return redirect('/dokter/dashboard');
            } elseif ($user->role === 'superadmin') {
                return redirect('/admin/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
