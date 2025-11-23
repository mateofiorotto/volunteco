<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Host;
use App\Models\Province;

class ProfileController extends Controller
{

    /**
     * Mostrar perfil propio
     */
    public function myProfile()
    {
        $userId = Auth::id();

        $host = Host::with('location.province', 'projects.volunteers')
            ->where('user_id', $userId)->firstOrFail();

        return view('user.host.my-profile.profile', compact('host'));
    }

    /**
     * devolver vista de perfil publico de anfitrion
     */
    public function getProfile($id)
    {
        //si el perfil esta inactivo o pendiente, no se puede ver. Si la id no existe, no se puede ver
        $host = Host::with('user')
            ->whereHas('user', function ($query) {
                $query->where('status', 'activo');
            })
            ->findOrFail($id);

        //paginar los proyectos
        $projects = $host->projects()
            ->where('enabled', true)
            ->latest()
            ->paginate(6);

        return view('user.host.my-profile.edit', compact('host', 'projects'));
    }

    /**
     * Vista de edicion de perfil
     */
    public function editMyProfile()
    {

        $provinces = Province::with('locations')->get();

        $host = Host::where('user_id', Auth::id())->with('user', 'location.province')->firstOrFail();

        return view('user.host.my-profile.edit', compact('host', 'provinces'));
    }

    /**
     * Actualizar perfil propio
     */
    public function updateMyProfile(Request $request)
    {
        //datos user logueado
        $host = Host::where('user_id', Auth::id())->with('location.province')->firstOrFail();

        $validatedHost = $request->validate([
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'cuit' => ['required', 'string', 'size:11', 'regex:/^\d+$/', Rule::unique('hosts', 'cuit')->ignore($host->id)],
            'person_full_name' => 'required|string|max:255|min:3',
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255|min:3|required_without_all:facebook,instagram',
            'facebook' => 'nullable|string|max:255|min:3|required_without_all:linkedin,instagram',
            'instagram' => 'nullable|string|max:255|min:3|required_without_all:facebook,linkedin',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
            'description' => 'required|string|max:5120|min:50',
            'location_id' => ['required', 'exists:locations,id'],
        ], [
            'linkedin.required_without_all' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).',
            'facebook.required_without_all' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).',
            'instagram.required_without_all' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).',
        ]);

        //foto de perfil
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('hosts','public');
            $validatedHost['avatar'] = $path;
        }

        //actualizar
        $host->update([
            'name' => $validatedHost['name'],
            'cuit' => $validatedHost['cuit'],
            'person_full_name' => $validatedHost['person_full_name'],
            'phone' => $validatedHost['phone'],
            'linkedin' => $validatedHost['linkedin'],
            'facebook' => $validatedHost['facebook'],
            'instagram' => $validatedHost['instagram'],
            'avatar' => $validatedHost['avatar'] ?? $host->avatar,
            'description' => $validatedHost['description'],
            'location_id' => $validatedHost['location_id'],
            //cuit y email no se editan
        ]);

        //cambiar pw y cerrar sesion
        if ($request->filled('password')) {
            $host->user->password = Hash::make($validatedHost['password']);
            $host->user->save();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('status', 'Contraseña actualizada. Debes volver a iniciar sesión.');
        }

        return redirect()->route('host.my-profile.profile')->with('success', 'Perfil actualizado correctamente.');
    }
}
