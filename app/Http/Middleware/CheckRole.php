<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Middleware untuk memvalidasi role user
     * 
     * @param string $role Role yang diizinkan (admin, bendahara)
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role === 'Bendahara') {
                return redirect()->route('home');
            }
            
            Auth::logout();
            return redirect()->route('login');
        }

        return $next($request);
    }
}
