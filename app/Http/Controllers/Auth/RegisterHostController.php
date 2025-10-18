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

class RegisterHostController extends Controller
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
        try {
            $request->validate([
                'email' => 'required|string|lowercase|email|max:255|unique:users,email',
                'password' => ['required', 'confirmed', Rules\Password::defaults()], //8 caracts
                'name' => 'required|string|max:255|min:3|unique:hosts,name',
                'person_full_name' => 'required|string|max:255|min:3',
                'cuit' => ['required', 'string', 'size:11', 'regex:/^\d+$/', 'unique:hosts,cuit'],
                'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
                'linkedin' => 'nullable|string|max:255|min:10',
                'facebook' => 'nullable|string|max:255|min:10',
                'instagram' => 'nullable|string|max:255|min:10',
                'avatar' => 'required|image|max:2048',
                'description' => 'required|string|max:500|min:50',
                'location' => 'nullable|string|max:255|min:3',
            ]);

            //al menos una RRSS
            if (empty($request->linkedin) && empty($request->facebook) && empty($request->instagram)) {
                dd("Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).");

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
            }

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $hostRole->id,
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
                'avatar' => $avatarPath,
                'description' => $request->description,
                'phone' => $request->phone,
                'location' => $request->location
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('home');
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
            //lanzar error con alertas y redirect despues
        }
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
        try {
            $user = User::where('email', $email)->with('host')->first();

            if (!$user || !$user->host) {
                return back()->withErrors(['error' => 'No se encontró el anfitrión']);
            }
            //validando solo campos de host, los de user no se pueden cambiar
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'min:3',
                    Rule::unique('hosts', 'name')->ignore($user->host->id), //valida que si es el mismo nombre no tire error
                ],
                'person_full_name' => 'required|string|max:255|min:3',
                'cuit' => [
                    'required',
                    'string',
                    'size:11',
                    'regex:/^\d+$/',
                    Rule::unique('hosts', 'cuit')->ignore($user->host->id), //valida que si es el mismo cuit no tire error
                ],
                'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
                'linkedin' => 'nullable|string|max:255|min:3',
                'facebook' => 'nullable|string|max:255|min:3',
                'instagram' => 'nullable|string|max:255|min:3',
                'avatar' => 'nullable|image|max:2048',
                'description' => 'required|string|max:500|min:50',
                'location' => 'nullable|string|max:255|min:3',
            ]);

            //al menos una red social
            if (empty($request->linkedin) && empty($request->facebook) && empty($request->instagram)) {
                 dd("Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).");

                 return back()->withErrors([
                    'social_media' => 'Debes proporcionar al menos una red social (LinkedIn, Facebook o Instagram).'
                ])->withInput();
            }

            //actualizar host
            $user = User::where('email', $email)->with('host')->first();

            if (!$user || !$user->host) {
                return back()->withErrors(['error' => 'No se encontró el anfitrión']);
            }

            //nueva imagen = actualizar y borrar la anterior
            if ($request->hasFile('avatar')) {
                $validated['avatar'] = $this->imageService->updateImage(
                    $request->file('avatar'), //pasando nueva img
                    $user->host->avatar, //img anterior a borrar
                    'hosts' //directorio nueva img
                );
            }

            $user->status = 'Pendiente';
            $user->save();

            $user->host->disabled_at = null;
            $user->host->rejection_reason = null;
            $user->host->update($validated); //updatear la lista de campos validados

            //borrar token
            DB::table('profile_change_tokens')->where('email', $email)->delete();

            return redirect()->route('home')->with('success', 'Tu perfil fue actualizado y está pendiente de revisión.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }
    }
}
