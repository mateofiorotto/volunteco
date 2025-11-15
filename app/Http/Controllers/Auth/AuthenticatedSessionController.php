<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Vista de login
     */
    public function create(): View
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return view('auth.login');
    }

    /**
     * Toma una request de login y autentica al usuario.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

        //obtener usuario
        $user = Auth::user();

        if ($user->status != 'activo') {
            Auth::logout();

            return redirect()->route('login')->with(
                'error', "Tu cuenta todavia no ha sido verificada o fue desactivada. Si crees que fue un error contacta con soporte."
            );
        }

        $request->session()->regenerate();

        if ($user->role && $user->role->type === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role && $user->role->type === 'host') {
            return redirect()->route('host.dashboard');
        }

        if ($user->role && $user->role->type === 'volunteer') {
            return redirect()->route('volunteer.dashboard');
        }

        //Por defecto (si no tiene rol)
        return redirect()->route('home');
    }

    /**
     * Desloguea a un usuario
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
