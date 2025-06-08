<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            // Regenerate the session to prevent session fixation
            $request->session()->regenerate();

            // Get the authenticated user
            $user = Auth::user();

            // Arahkan berdasarkan role
            if ($user->role === 'apoteker') {
                return redirect('/apoteker/dashboard');
            } elseif ($user->role === 'dokter') {
                return redirect('/dokter/dashboard');
            } elseif ($user->role === 'superadmin') {
                return redirect('/admin/dashboard');
            } else {
                // Log out the user if the role is unrecognized
                Auth::logout();
                // Optionally, log the failed attempt for debugging
                Log::warning("Login attempt with unrecognized role for email: {$user->email}");
                return back()->withErrors(['email' => 'Role tidak dikenali.']);
            }
        }

        // Log failed login attempt
        Log::warning("Failed login attempt for email: {$request->email}");

        // Return back with error if login fails
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
