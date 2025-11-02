<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use App\Models\Host;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Services\ImageService;

class ProfileController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * devolver vista de perfil publico de anfitrion
     */
    public function getProfile($id)
    {
        $host = Host::with('user')->findOrFail($id);

        return view('user.host.profile.show', compact('host'));
    }

    /**
     * Vista de edicion de perfil
     */
    public function editMyProfile()
    {
        $userId = Auth::id();

        //si no esta auth
        if (!$userId) {
            abort(403); //tirar error no autorizado
        }

        $host = Host::with('user')->where('user_id', $userId)->firstOrFail();

        return view('user.host.profile.edit', compact('host'));
    }

    /**
     * Actualizar perfil propio
     */
    public function updateMyProfile(Request $request)
    {
        //datos user logueado
        $user = Auth::user();
        $host = $user->host;

        $request->validate([
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'name' => 'required|string|max:255|min:3',
            'person_full_name' => 'required|string|max:255|min:3',
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimetypes:jpeg,png,jpg,gif,WebP|max:100|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
            'description' => 'required|string|max:1000|min:50',
            'location' => 'required|string|max:255|min:3',
        ]);

        //foto de perfil
        if ($request->hasFile('avatar')) {
            $avatarPath = $this->imageService->storeImage($request->file('avatar'), 'hosts');
        } else {
            $avatarPath = $host->avatar;
        }

        //actualizar
        $host->update([
            'name' => $request->name,
            'person_full_name' => $request->person_full_name,
            'phone' => $request->phone,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'avatar' => $avatarPath,
            'description' => $request->description,
            'location' => $request->location,
            //cuit y email no se editan
        ]);

        //cambiar pw y cerrar sesion
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
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
