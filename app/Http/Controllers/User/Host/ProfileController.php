<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Services\ImageService;
use App\Models\User;
use App\Models\Host;
use App\Models\Province;

class ProfileController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function show()
    {
        $host = Auth::user()->host()->with('location.province', 'projects.volunteers')->firstOrFail();

        return view('user.host.profile.show', compact('host'));
    }

    public function edit($id)
    {
        $provinces = Province::with('locations')->get();
        $host = Auth::user()->host()->with('location.province', 'projects.volunteers')->firstOrFail();
        return view('user.host.profile.edit', compact('host', 'provinces'));
    }

    public function update(Request $request, User $user)
    {
        $host = Auth::user()->host()->with('location.province', 'projects.volunteers')->firstOrFail();

        //validación de campos
        $validatedHost = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'person_full_name' => 'required|string|max:255|min:3',
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255|min:3|required_without_all:facebook,instagram',
            'facebook' => 'nullable|string|max:255|min:3|required_without_all:linkedin,instagram',
            'instagram' => 'nullable|string|max:255|min:3|required_without_all:facebook,linkedin',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
            'description' => 'required|string|max:500|min:50',
            'location_id' => ['required', 'exists:locations,id'],
        ], [
            'linkedin.required_without_all' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).',
            'facebook.required_without_all' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).',
            'instagram.required_without_all' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).',
        ]);

        //actualizar avatar si hay nueva imagen
        if ($request->hasFile('avatar')) {
            $path = $this->imageService->storeImage($request->file('avatar'), 'hosts');
            $validatedHost['avatar'] = basename($path);
        }


        //actualizar
        $host->update([
            'name' => $validatedHost['name'],
            'person_full_name' => $validatedHost['person_full_name'],
            'phone' => $validatedHost['phone'],
            'linkedin' => $validatedHost['linkedin'] ?? null,
            'facebook' => $validatedHost['facebook'] ?? null,
            'instagram' => $validatedHost['instagram'] ?? null,
            'avatar' => $validatedHost['avatar'] ?? $host->avatar,
            'description' => $validatedHost['description'],
            'location_id' => $validatedHost['location_id'],
            //cuit y email no se editan
        ]);

        return redirect()->route('host.my-profile.show')->with('success', 'Perfil actualizado correctamente.');

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

        return view('user.host.profile.show', compact('host', 'projects'));
    }

    /**
     * Vista de edicion de perfil
     */
    public function editMyProfile($id)
    {

        $host = Host::with('user')->firstOrFail($id);
        $provinces = Province::with('locations')->get();

        return view('user.host.profile.edit', compact('host', 'province'));
    }

    /**
     * Actualizar perfil propio
     */
    public function updateMyProfile(Request $request)
    {
        //datos user logueado
        $user = Auth::user();
        $host = $user->host;

        $validatedHost = $request->validate([
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'name' => ['required', 'string', 'max:255', 'min:3', Rule::unique('hosts', 'name')->ignore($host->id)],
            'person_full_name' => 'required|string|max:255|min:3',
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
            'description' => 'required|string|max:5120|min:50',
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        //foto de perfil
        if ($request->hasFile('avatar')) {
            $path = $this->imageService->storeImage($request->file('avatar'), 'hosts');
            $validatedHost['avatar'] = basename($path);
        }

        //actualizar
        $host->update([
            'name' => $validatedHost['name'],
            'person_full_name' => $validatedHost['person_full_name'],
            'phone' => $validatedHost['phone'],
            'linkedin' => $validatedHost['linkedin'],
            'facebook' => $validatedHost['facebook'],
            'instagram' => $validatedHost['instagram'],
            'avatar' => $validatedHost['avatar'],
            'description' => $validatedHost['description'],
            'location_id' => $validatedHost['location_id'],
            //cuit y email no se editan
        ]);

        //cambiar pw y cerrar sesion
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedHost['password']);
            $user->save();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('status', 'Contraseña actualizada. Debes volver a iniciar sesión.');
        }

        return redirect()->route('hosts.host-profile', ['id' => $host->id])
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
