<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if (Auth::check()) {
            $user = Auth::user();
            // Si el usuario no está habilitado
            if (!$user->enabled) {
                Auth::logout(); // desloguear
                return redirect('/login')->with('error', 'Tu cuenta no está habilitada.');
            }
        }

        return $next($request);
    }
}
