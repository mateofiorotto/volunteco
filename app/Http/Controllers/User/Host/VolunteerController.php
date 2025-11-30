<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    //
    public function profile($id)
    {
        $volunteer = Volunteer::with(['user'])->findOrFail($id);

        $host = Auth::user()->host;

        /**
         * El host solo puede ver perfiles de voluntarios que solo estan aplicados a alguno de sus proyectos
         * si intenta ver por url otro perfil lo redirecciona a los proyectos con un mensaje de error
         * esto esta definido en una policy VolunteerPolicy
         * https://laravel.com/docs/12.x/authorization#via-the-user-model
         */
        if (Gate::denies('view', $volunteer)) {
            return redirect()->route('host.my-projects.index')->with('error', 'No tienes permiso para ver el perfil del usuario solicitado.');
        }

        /**
         * Esto me devuelve si el voluntario esta al menos aceptado en algun proyecto
         */
        $hasAccepted = $host->hasVolunteer($volunteer->id);

        $projects = $host->projectsWithVolunteer($volunteer->id);

        return view('user.host.volunteers.profile', compact('volunteer', 'hasAccepted', 'projects'));
    }
}
