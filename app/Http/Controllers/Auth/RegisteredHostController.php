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
use Illuminate\Validation\Rule;
use App\Models\Host;
use App\Services\ImageService;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;

class RegisteredHostController extends Controller
{
    protected $imageService;

    //inyectar el servicio de imgs
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Vista de registro de anfitrion
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
        $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()], //8 caracts
            'name' => 'required|string|max:255|min:3|unique:hosts,name',
            'cuit' => ['required', 'string', 'size:11', 'regex:/^\d+$/', 'unique:hosts,cuit'],
            'person_full_name' => 'required|string|max:255|min:3',
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255|min:3',
            'facebook' => 'nullable|string|max:255|min:3',
            'instagram' => 'nullable|string|max:255|min:3',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
            'description' => 'required|string|max:500|min:50',
            'location' => 'nullable|string|max:255|min:3',
        ]);

         //validación de al menos una red social
        if (empty($request->linkedin) && empty($request->facebook) && empty($request->instagram)) {
            return back()->withErrors([
                'social_media' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).'
            ])->withInput();
        }

        $hostRole = Role::where('type', 'host')->first();

        if (!$hostRole) {
            return back()->withErrors(['role' => 'No se encontró el rol "host".']);
        }

        if ($request->hasFile('avatar')) {
            $avatarPath = $this->imageService->storeImage($request->file('avatar'), 'hosts');
        } else {
            $avatarPath = 'logo.svg';
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $hostRole->id,
            'status' => 'pendiente'
        ]);

        Host::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'person_full_name' => $request->person_full_name,
            'cuit' => $request->cuit,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'avatar' => $avatarPath,
            'description' => $request->description,
            'phone' => $request->phone,
            'location' => $request->location
        ]);

        event(new Registered($user));

        return redirect()->route('login')
        ->with('success', 'Tu cuenta fue creada. Estaremos revisando los datos y te notificaremos cuando esté aprobada.');
    }

    /**
     * Vista de form de edicion
     */
    public function edit($token, $email)
    {
        Auth::logout();

        $tokenData = DB::table('profile_change_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$tokenData || $tokenData->created_at < now()->subHours(48)) {
            abort(403, 'El enlace ha expirado o es inválido.');
        }

        $host = User::with('host')->where('email', $email)->firstOrFail();

        return view('auth.edit-rejected-profile', ['host' => $host, 'token' => $token, 'email' => $email]);
    }

    /**
     * Metodo de actualizacion
     */
    public function update(Request $request, $token, $email)
    {
        $user = User::where('email', $email)->with('host')->first();

        if (!$user || !$user->host) {
            return back()->withErrors(['error' => 'No se encontró el anfitrión']);
        }

        //validación de campos
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                Rule::unique('hosts', 'name')->ignore($user->host->id),
            ],
            'person_full_name' => 'required|string|max:255|min:3',
            'cuit' => [
                'required',
                'string',
                'size:11',
                'regex:/^\d+$/',
                Rule::unique('hosts', 'cuit')->ignore($user->host->id),
            ],
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255|min:3',
            'facebook' => 'nullable|string|max:255|min:3',
            'instagram' => 'nullable|string|max:255|min:3',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
            'description' => 'required|string|max:500|min:50',
            'location' => 'nullable|string|max:255|min:3',
        ]);

         //validación de al menos una red social
        if (empty($request->linkedin) && empty($request->facebook) && empty($request->instagram)) {
            return back()->withErrors([
                'social_media' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).'
            ])->withInput();
        }

        //actualizar avatar si hay nueva imagen
        if ($request->hasFile('avatar')) {
            if ($user->host->avatar == 'perfil-host.svg') {
                $validated['avatar'] = $this->imageService->storeImage($request->file('avatar'), 'hosts');
            } else {
                $validated['avatar'] = $this->imageService->updateImage(
                    $request->file('avatar'),
                    $user->host->avatar,
                    'hosts'
                );
            }
        }

        // actualizar usuario y host
        $user->status = 'pendiente';
        $user->save();

        $user->host->disabled_at = null;
        $user->host->rejection_reason = null;
        $user->host->update($validated);

        // borrar token
        DB::table('profile_change_tokens')->where('email', $email)->delete();

         return redirect()->route('login')
        ->with('success', 'Tu perfil fue actualizado. Estaremos revisando los datos y te notificaremos cuando esté aprobado.');
    }
}
