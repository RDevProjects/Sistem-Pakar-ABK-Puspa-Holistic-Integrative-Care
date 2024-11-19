<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAndRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika tidak login, arahkan ke halaman login
            return redirect()->route('/');
        }

        // Cek apakah role pengguna cocok
        $user = Auth::user();
        if ($user->role !== $role) {
            // Jika role tidak cocok, arahkan ke halaman yang sesuai
            if ($role === 'admin') {
                return redirect()->route('home');  // Misalnya ke halaman utama untuk user
            } else {
                return redirect()->route('home');  // Bisa menyesuaikan sesuai kebutuhan
            }
        }

        // Lanjutkan ke proses berikutnya
        return $next($request);
    }
}
