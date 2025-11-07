<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsHost
{
    /**
     * Chequear si el usuario es host
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

       $user = Auth::user();

        if (!$user || !$user->hasRole('host')) {
            return redirect()->route('login')
                ->with('error', 'No tienes permiso para acceder a esta página. Por favor, inicia sesión como anfitrión');
        }

        return $next($request);
    }
}
