<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    /**
     * Chequear si hay un usuario logueado
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) { // si no hay usuario logueado
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página');
        }

        $user = Auth::user();

        return $next($request);
    }
}
