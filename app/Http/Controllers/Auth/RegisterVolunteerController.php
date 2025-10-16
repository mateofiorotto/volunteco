<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
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
     * Vista de registro de voluntarios
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
        try {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'full_name' => 'required|string|max:255|min:3',
                'dni' => ['required', 'string', 'size:8', 'regex:/^\d+$/', 'unique:volunteers,dni'],
                'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
                'linkedin' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'instagram' => 'nullable|string|max:255',
                'avatar' => 'required|image|max:2048',
                'biography' => 'required|string|max:500|min:50',
                'educational_level' => 'required|string',
                'profession' => 'nullable|string|max:255|min:3',
                'location' => 'required|string|max:255|min:3',
                'birthdate' => [
                    'required',
                    'date',
                    'before:' . now()->subYears(18)->toDateString(),
                ],
            ]);

            $hostRole = Role::where('type', 'volunteer')->first();

            if (!$hostRole) {
                return back()->withErrors(['role' => 'No se encontró el rol "volunteer".']);
            }

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $hostRole->id,
                'status' => 'Activo'
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

            return redirect()->route('home');
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
            //lanzar error con alertas y redirect despues
        }
    }
};
