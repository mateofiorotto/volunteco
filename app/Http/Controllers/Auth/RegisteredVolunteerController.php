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
use App\Services\ImageService;
use App\Models\Volunteer;
use App\Models\Province;

class RegisteredVolunteerController extends Controller
{
    protected $imageService;

    //inyectar el servicio de imgs
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Vista de registro de voluntarios
     */
    public function create()
    {
        $provinces = Province::with('locations')->get();

        return view('auth/register-volunteer', compact('provinces'));
    }

    /**
     * Registra un nuevo anfitrion. Revision manual
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
            $validatedVolunteer = $request->validate([
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'full_name' => 'required|string|max:255|min:3',
                'dni' => ['required', 'string', 'size:8', 'regex:/^\d+$/', 'unique:volunteers,dni'],
                'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
                'linkedin' => 'nullable|string|max:255|min:3',
                'facebook' => 'nullable|string|max:255|min:3',
                'instagram' => 'nullable|string|max:255|min:3',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:512|dimensions:min_width=100,min_height=100,max_width=300,max_height=300',
                'biography' => 'required|string|max:500|min:50',
                'educational_level' => 'required|string',
                'profession' => 'nullable|string|max:255|min:3',
                'location_id' => ['required', 'exists:locations,id'],
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

            if ($request->hasFile('avatar')) {
                $path = $this->imageService->storeImage($request->file('avatar'), 'volunteers');
                $validatedHost['avatar'] = basename($path);
            }

            $user = User::create([
                'email' => $validatedVolunteer['email'],
                'password' => Hash::make($validatedVolunteer['password']),
                'role_id' => $hostRole->id,
                'status' => 'activo'
            ]);

            Volunteer::create([
                'user_id' => $user->id,
                'full_name' => $validatedVolunteer['full_name'],
                'dni' => $validatedVolunteer['dni'],
                'phone' => $validatedVolunteer['phone'],
                'linkedin' => $validatedVolunteer['linkedin'],
                'facebook' => $validatedVolunteer['facebook'],
                'instagram' => $validatedVolunteer['instagram'],
                'avatar' => $validatedHost['avatar'],
                'biography' => $validatedVolunteer['biography'],
                'educational_level' => $validatedVolunteer['educational_level'],
                'profession' => $validatedVolunteer['profession'],
                'location' => $validatedVolunteer['location'],
                'birthdate' => $validatedVolunteer['birthdate']
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('home');
    }
};
