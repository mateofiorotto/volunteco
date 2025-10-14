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
     * Display the login view.
     */
    public function create(): View
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        //implementar que si el user type es anfitrion y status distinto de activo no se loguee
        $request->authenticate();

        //obtener usuario
        $user = Auth::user();

        if ($user->status != 'Activo') {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => "Tu cuenta todavia no ha sido verificada o fue desactivada. Si crees que fue un error contacta con soporte"
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
