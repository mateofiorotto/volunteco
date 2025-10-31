<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;

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
        ->get();

        return view('admin.volunteers.index', compact('volunteers'));
    }


    /**
     * Obtener un perfil de un voluntario por id
     */
    public function getVolunteerProfileById($id)
    {
        $volunteer = User::where('id', $id)->with('volunteer')->firstOrFail();

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

        $volunteer->volunteer->disabled_at = null;
        $volunteer->volunteer->save();

        return redirect()->route('admin.volunteers.index');
    }

    /*
     * Desactivar un perfil de un voluntario
     */
    public function disableVolunteerProfile($id)
    {
        $volunteer = User::where('id', $id)->first();

        $volunteer->status = "inactivo";
        $volunteer->save();

        $volunteer->volunteer->disabled_at = now();
        $volunteer->volunteer->save();

        return redirect()->route('admin.volunteers.index');
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

        //Mail::to($volunteer->email)->send(new volunteerDeleteProfileMail($reasons['delete_reasons'], $volunteer->volunteer->person_full_name));

        return redirect()->route('admin.volunteers.index');
    }
}
