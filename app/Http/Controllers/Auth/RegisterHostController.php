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
use App\Models\Host;

class RegisterHostController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth/register-host');
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
                'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()], //8 caracts
                'name' => 'required|string|max:255|min:5',
                'person_full_name' => 'required|string|max:255|min:10',
                'cuit' => ['required', 'string', 'size:11', 'regex:/^\d+$/'],
                'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
                'linkedin' => 'required|string|max:255|min:10',
                'facebook' => 'required|string|max:255|min:10',
                'instagram' => 'required|string|max:255|min:10',
                'avatar' => 'required|image|max:2048',
                'description' => 'required|string|max:500|min:100',
                'location' => 'nullable|string|max:255|min:10',
            ]);


            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => 'Anfitrión',
                'status' => 'Pendiente'
            ]);

            Host::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'person_full_name' => $request->person_full_name,
                'cuit' => $request->cuit,
                'linkedin' => $request->linkedin,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'avatar' => $request->avatar,
                'description' => $request->description,
                'phone' => $request->phone,
                'location' => $request->location
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('home', absolute: false));
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
            //lanzar error con alertas y redirect despues
        }
    }
}
