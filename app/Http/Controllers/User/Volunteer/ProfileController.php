<?php

namespace App\Http\Controllers\User\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Services\ImageService;
use App\Models\Volunteer;

class ProfileController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
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
    public function editMyProfile()
    {
        $userId = Auth::id();

        //si el usuario no es el mismo
        if (!$userId) {
            abort(403); //tirar error no autorizado
        }

        $volunteer = Volunteer::with('user')->where('user_id', $userId)->firstOrFail();

        return view('user.volunteer.profile.edit', compact('volunteer'));
    }

    /**
     * Actualizar perfil propio
     *
     */
    public function updateMyProfile(Request $request)
    {
        //datos del usuario q esta logueado
        $user = Auth::user();
        $volunteer = $user->volunteer;

        //validaciones
        $request->validate([
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], //pw no requerido
            'full_name' => 'required|string|max:255|min:3',
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
            'biography' => 'required|string|max:500|min:50',
            'educational_level' => 'required|string',
            'profession' => 'nullable|string|max:255|min:3',
            'location' => 'required|string|max:255|min:3',
            'birthdate' => ['required', 'date', 'before:' . now()->subYears(18)->toDateString()],
        ]);

        //foto de perfil
        if ($request->hasFile('avatar')) {
            $avatarPath = $this->imageService->storeImage($request->file('avatar'), 'volunteers');
        } else {
            $avatarPath = $volunteer->avatar;
        }

        //actualizar
        $volunteer->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'avatar' => $avatarPath,
            'biography' => $request->biography,
            'educational_level' => $request->educational_level,
            'profession' => $request->profession,
            'location' => $request->location,
            'birthdate' => $request->birthdate,
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

        return redirect()->route('volunteers.volunteer-profile', ['id' => $volunteer->id])->with('success', 'Perfil actualizado correctamente.'); //redirigir a la vista de perfil
    }
}
