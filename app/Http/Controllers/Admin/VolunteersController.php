<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Mail\VolunteerDeleteProfileMail;
use App\Mail\VolunteerDisableProfileMail;
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
        $volunteers = User::whereHas('role', function ($query) {
            $query->where('type', 'volunteer');
        })
            ->with('volunteer')
            ->paginate(6);

        return view('admin.volunteers.index', compact('volunteers'));
    }


    /**
     * Obtener un perfil de un voluntario por id
     */
    public function getVolunteerProfileById($id)
    {
        //$volunteer = User::where('id', $id)->with('volunteer')->firstOrFail();

        $volunteer = User::where('id', $id)
        ->whereHas('role', fn($q) => $q->where('type', 'volunteer'))
        ->with(['volunteer.projects', 'volunteer.location.province'])
        ->firstOrFail();


        //$host = User::with('host.projects.volunteers', 'host.location.province')->findOrFail($id);

        return view('admin.volunteers.profile', ['volunteer' => $volunteer]);
    }

    /**
     * Reactivar un perfil de un voluntario
     */
    public function reenableVolunteerProfile($id)
    {
        $volunteer = User::where('id', $id)->first();

        $volunteer->status = "activo";
        $volunteer->save();

        $volunteer->volunteer->save();

        return redirect()->route('admin.volunteers.index')->with('success', 'Perfil de voluntario reactivado correctamente.');
    }

    /*
     * Desactivar un perfil de un voluntario
     */
    public function disableVolunteerProfile($id)
    {
        $volunteer = User::findOrFail($id);
        $volunteerProfile = $volunteer->volunteer;

        $volunteer->status = "inactivo";
        $volunteer->save();

        if ($volunteerProfile && $volunteerProfile->projects()->exists()) {
            $volunteerProfile->projects()->detach(); // elimina todas las filas en la tabla pivote
        }

        Mail::to($volunteer->email)->send(new VolunteerDisableProfileMail($volunteer->volunteer->full_name));

        return redirect()->route('admin.volunteers.index')->with('success', 'Perfil de voluntario desactivado correctamente y notificación enviada por email.');
    }

    /**
     * Eliminar un perfil de un voluntario y enviar mail notificando la eliminacion
     */
    public function deleteVolunteerProfile($id)
    {
        $volunteer = User::where('id', $id)->firstOrFail();

        if ($volunteer->volunteer->avatar && $volunteer->volunteer->avatar !== 'logo.svg') {
            $this->imageService->deleteImage($volunteer->volunteer->avatar);
        }

        $volunteer->delete();

        Mail::to($volunteer->email)->send(new VolunteerDeleteProfileMail($volunteer->volunteer->full_name));

        return redirect()->route('admin.volunteers.index')->with('success', "Perfil eliminado correctamente y notificación enviada por email.");
    }
}
