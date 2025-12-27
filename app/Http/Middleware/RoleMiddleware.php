<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
{
    // 1. Cek apakah sudah login
    if (!auth()->check()) {
        return redirect('/login');
    }

    // 2. Cek apakah role sesuai
    if (auth()->user()->role !== $role) {
        // Jika petugas mencoba akses rute warga, kembalikan ke dashboard petugas
        if (auth()->user()->role === 'officer') {
            return redirect()->route('officer.dashboard')->with('error', 'Akses ditolak.');
        }
        
        // Jika warga mencoba akses rute petugas, kembalikan ke dashboard warga
        if (auth()->user()->role === 'warga') {
            return redirect()->route('warga.dashboard')->with('error', 'Akses ditolak.');
        }

        // Jika benar-benar tidak dikenal
        abort(403, 'Akses ditolak.');
    }

    return $next($request);
}
}
