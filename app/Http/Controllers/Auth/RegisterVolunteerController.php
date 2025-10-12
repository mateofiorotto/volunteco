<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Models\Volunteer;

class RegisterVolunteerController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth/register-volunteer');
    }

    /**
     * Registra un nuevo anfitrion. Revision manual
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'full_name' => 'required|string|max:255|min:10',
            'dni' => ['required', 'string', 'size:8', 'regex:/^\d+$/'],
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'avatar' => 'required|image|max:2048',
            'biography' => 'required|string|max:500|min:100',
            'educational_level' => 'required|string',
            'profession' => 'nullable|string|max:255|min:10',
            'location' => 'required|string|max:255|min:10',
            'birthdate' => 'required|date',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'Voluntario',
            'enabled' => true,
        ]);

        Volunteer::create([
            'user_id' => $user->id,
            'full_name' => $request->full_name,
            'dni' => $request->dni,
            'phone' => $request->phone,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'avatar' => $request->avatar,
            'biography' => $request->biography,
            'educational_level' => $request->educational_level,
            'profession' => $request->profession,
            'location' => $request->location,
            'birthdate' => $request->birthdate
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
};
