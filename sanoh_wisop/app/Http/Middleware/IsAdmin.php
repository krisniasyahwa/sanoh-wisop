<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah pengguna sudah login dan apakah perannya adalah admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Jika pengguna bukan admin, arahkan ke halaman lain, misalnya halaman utama
        return redirect('/home')->with('error', 'Anda tidak memiliki akses untuk halaman ini.');
    }
}
