<?php

namespace App\Http\Controllers\User\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Services\ImageService;
use App\Models\Volunteer;
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
        $volunteer = Auth::user()->volunteer()->with('location.province')->firstOrFail();

        return view('user.volunteer.profile.show', compact('volunteer'));
    }

    /**
     * Devolver vista de perfil publico de voluntario
     */
    public function getProfile($id)
    {
        $volunteer = Volunteer::with('user')
        ->whereHas('user', function($query) {
            $query->where('status', 'activo');
        })
        ->findOrFail($id);

        return view('user.volunteer.profile.show', compact('volunteer'));
    }

    /**
     * vista de edicion de perfil
     */
    public function edit($id)
    {
        $provinces = Province::with('locations')->get();

        $volunteer = Auth::user()->volunteer()->with('location.province')->firstOrFail();

        return view('user.volunteer.profile.edit', compact('volunteer', 'provinces'));
    }

    /**
     * Actualizar perfil propio
     *
     */
    public function update(Request $request)
    {

        //datos del usuario q esta logueado
        $volunteer = Auth::user()->volunteer()->with('location.province')->firstOrFail();

        //validaciones
        $validatedVolunteer = $request->validate([
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], //pw no requerido
            'name' => 'required|string|max:255|min:3',
            'lastname' => 'required|string|max:255|min:3',
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
            'biography' => 'required|string|max:500|min:50',
            'educational_level' => 'required|string',
            'profession' => 'nullable|string|max:255|min:3',
            'location_id' => ['required', 'exists:locations,id'],
            'birthdate' => ['required', 'date', 'before:' . now()->subYears(18)->toDateString()],
        ]);

        //foto de perfil
        if ($request->hasFile('avatar')) {
            $validatedVolunteer['avatar'] = $this->imageService->storeImage($request->file('avatar'), 'volunteers');
        }

        //actualizar
        $volunteer->update([
            'name' => $validatedVolunteer['name'],
            'lastname' => $validatedVolunteer['lastname'],
            'phone' => $validatedVolunteer['phone'],
            'linkedin' => $validatedVolunteer['linkedin'],
            'facebook' => $validatedVolunteer['facebook'],
            'instagram' => $validatedVolunteer['instagram'],
            'avatar' => $validatedVolunteer['avatar'] ?? $volunteer->avatar,
            'biography' => $validatedVolunteer['biography'],
            'educational_level' => $validatedVolunteer['educational_level'],
            'profession' => $validatedVolunteer['profession'],
            'location_id' => $validatedVolunteer['location_id'],
            'birthdate' => $validatedVolunteer['birthdate'],
            // 'dni' y 'email' NO se lo permitimos editar al user
        ]);


        // si cambió la contraseña, se cierra la sesion por motivos de seguridad
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('status', 'Contraseña actualizada. Debes volver a iniciar sesión.');
        }

        return redirect()->route('volunteer.my-profile.show')->with('success', 'Perfil actualizado correctamente.'); //redirigir a la vista de perfil
    }
}
