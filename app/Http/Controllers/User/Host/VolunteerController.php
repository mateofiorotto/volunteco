<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Gate;

class VolunteerController extends Controller
{
    //
    public function show($id)
    {
        $volunteer = Volunteer::with(['user'])->findOrFail($id);

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
        $hasAccepted = $volunteer->projects->contains(function ($project) {
            return $project->pivot->status === 'aceptado';
        });

        return view('user.host.volunteers.show', compact('volunteer', 'hasAccepted'));
    }
}
