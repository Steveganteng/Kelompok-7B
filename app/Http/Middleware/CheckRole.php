<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string    $role  Role yang diizinkan (atau beberapa, pisah koma)
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Belum login
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role; // field 'role' di tabel users

        // Bisa terima lebih dari satu role: "apoteker,dokter"
        $roles = explode(',', $role);
        if (! in_array($userRole, $roles)) {
            abort(403, 'Unauthorized.'); // atau redirect ke halaman lain
        }

        return $next($request);
    }
}
