<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Chequear si el usuario es admin
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //chequear si es admin
        //cambiar email por alertas mas adelante
        if (!Auth::check() || Auth::user()->role_id != 1) {
            return redirect()->route('login')
                ->withErrors(['email' => 'No tienes permiso para acceder a esta página. Por favor, inicia sesión como administrador']);
        }

        return $next($request);
    }
}
