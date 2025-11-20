<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Mail\VolunteerDeleteProfileMail;
use App\Mail\VolunteerDisableProfileMail;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Mail;

class VolunteersController extends Controller
{
    protected $imageService;

    //inyectar el servicio de imgs
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Vista de listado de voluntarios
     */
    public function index()
    {
        $volunteers = Volunteer::with('user.volunteer')->latest()->paginate(8);

        return view('admin.volunteers.index', compact('volunteers'));
    }

    /**
     * Obtener un perfil de un voluntario por id
     */
    public function getVolunteerProfileById($id)
    {
        $volunteer = Volunteer::where('id', $id)
            ->with(['user','projects','location.province'])
            ->firstOrFail();

        return view('admin.volunteers.profile', ['volunteer' => $volunteer]);
    }

    /**
     * Reactivar un perfil de un voluntario
     */
    public function reenableVolunteerProfile($id)
    {
        $user = User::where('id', $id)->first();

        $user->status = "activo";
        $user->save();

        $user->volunteer->save();

        return redirect()->route('admin.volunteers.index')->with('success', 'Perfil de voluntario reactivado correctamente.');
    }

    /*
     * Desactivar un perfil de un voluntario
     */
    public function disableVolunteerProfile($id)
    {
        $user = User::with('volunteer')->findOrFail($id);
        $volunteerProfile = $user->volunteer;

        $user->status = "inactivo";
        $user->save();

        if ($volunteerProfile && $volunteerProfile->projects()->exists()) {
            $volunteerProfile->projects()->detach(); // elimina todas las filas en la tabla pivot
        }

        Mail::to($user->email)->send(new VolunteerDisableProfileMail($user->volunteer->full_name));

        return redirect()->route('admin.volunteers.index')->with('success', 'Perfil de voluntario desactivado correctamente y notificación enviada por email.');
    }

    /**
     * Eliminar un perfil de un voluntario y enviar mail notificando la eliminacion
     */
    public function deleteVolunteerProfile($id)
    {
        $user = User::with('volunteer')->findOrFail($id);

        // Chequeo que tenga voluntario y si lo tiene checkea que tenga avatar sino es null
        if ($user->volunteer?->avatar) {
            $this->imageService->deleteImage($user->volunteer->avatar);
        }

        Mail::to($user->email)->send(new VolunteerDeleteProfileMail($user->volunteer->full_name));

        // Elimino tambien el perfil del volunteer
        $user->volunteer?->delete();

        $user->delete();

        return redirect()->route('admin.volunteers.index')->with('success', "Perfil eliminado correctamente y notificación enviada por email.");
    }
}
