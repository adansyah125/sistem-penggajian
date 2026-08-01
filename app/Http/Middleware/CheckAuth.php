<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah pengguna sudah login
        if (Auth::check()) {
            return $next($request);
        }

        // Jika tidak login, redirect ke halaman login
        return redirect()->route('login')->with('error', 'You need to log in to access this page.');
    }
}
