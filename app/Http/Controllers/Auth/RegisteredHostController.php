<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Services\ImageService;
use App\Models\Host;
use App\Models\Province;
use App\Models\Location;

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
        $provinces = Province::with('locations')->get();

        return view('auth.register-host', compact('provinces'));
    }

    /**
     * Registra un nuevo anfitrion. Revision manual
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $validatedHost = $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()], //8 caracts
            'name' => 'required|string|max:255|min:3|unique:hosts,name',
            'cuit' => ['required', 'string', 'size:11', 'regex:/^\d+$/', 'unique:hosts,cuit'],
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


        $hostRole = Role::where('type', 'host')->first();

        if (!$hostRole) {
            return back()->withErrors(['role' => 'No se encontró el rol "host".']);
        }

        $validatedHost['avatar'] = $request->hasFile('avatar')
            ? $this->imageService->storeImage($request->file('avatar'), 'hosts') :
            null;

        $user = User::create([
            'email' => $validatedHost['email'],
            'password' => Hash::make($validatedHost['password']),
            'role_id' => $hostRole->id,
            'status' => 'pendiente'
        ]);

        Host::create([
            'user_id' => $user->id,
            'name' => $validatedHost['name'],
            'person_full_name' => $validatedHost['person_full_name'],
            'cuit' => $validatedHost['cuit'],
            'linkedin' => $validatedHost['linkedin'],
            'facebook' => $validatedHost['facebook'],
            'instagram' => $validatedHost['instagram'],
            'avatar' => $validatedHost['avatar'],
            'description' => $validatedHost['description'],
            'phone' => $validatedHost['phone'],
            'location_id' => $validatedHost['location_id'],
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Tu cuenta fue creada. Estaremos revisando los datos y te notificaremos cuando esté aprobada.');
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
        $provinces = Province::with('locations')->get();

        return view('auth.edit-rejected-profile', ['host' => $host, 'token' => $token, 'email' => $email, 'provinces' => $provinces]);
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
        $validatedHost = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3', Rule::unique('hosts', 'name')->ignore($user->host->id)],
            'person_full_name' => 'required|string|max:255|min:3',
            'cuit' => ['required', 'string', 'size:11', 'regex:/^\d+$/', Rule::unique('hosts', 'cuit')->ignore($user->host->id)],
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
            $validatedHost['avatar'] = $this->imageService->storeImage($request->file('avatar'), 'hosts');
        }

        // actualizar usuario y host
        $user->status = 'pendiente';
        $user->save();

        $user->host->disabled_at = null;
        $user->host->rejection_reason = null;
        $user->host->update($validatedHost);

        // borrar token
        DB::table('profile_change_tokens')->where('email', $email)->delete();

         return redirect()->route('login')->with('success', 'Tu perfil fue actualizado. Estaremos revisando los datos y te notificaremos cuando esté aprobado.');
    }

    public function getLocationsByProvince($provinceId)
    {
        $locations = Location::where('province_id', $provinceId)->get();

        return response()->json($locations);
    }

}
