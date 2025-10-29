<?php

namespace App\Http\Controllers\User\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class VolunteerProjectController extends Controller
{
    /**
     * Mostrar lista de proyectos a los que el voluntario ha aplicado
     */
    public function volunteerAppliedProjects()
    {
        $volunteer = Auth::user()->volunteer;

        if (!$volunteer) {
            return redirect()->back()->with('error', 'No tienes un perfil de voluntario');
        }

        // Obtener proyectos con el estado de la aplicación
        $appliedProjects = $volunteer->projects()
            ->withPivot('status', 'applied_at', 'accepted_at')
            ->with(['host', 'projectType', 'conditions'])
            ->where('projects.enabled', true) //solo mostrar si esta habilitado
            ->orderByPivot('applied_at', 'desc')
            ->paginate(10);

        return view('user.volunteer.projects.applied', compact('appliedProjects'));
    }

    /**
     * Aplicar a un proyecto
     */
    public function applyProject(Project $project)
    {
        $volunteer = Auth::user()->volunteer;

        if (!$project->enabled) {
            return redirect()->back()->with('error', 'Este proyecto no está disponible actualmente');
        }

        if ($volunteer->projects()->where('project_id', $project->id)->exists()) {
            return redirect()->back()->with('error', 'Ya has aplicado a este proyecto');
        }

        $volunteer->projects()->attach($project->id, [
            'status' => 'pendiente',
            'applied_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Has aplicado al proyecto exitosamente. El anfitrión revisará tu solicitud.');
    }

    /**
     * Desistir de un proyecto
     */
    public function withdrawFromProject(Project $project)
    {
        $volunteer = Auth::user()->volunteer;

        $application = $volunteer->projects()
            ->where('project_id', $project->id)
            ->first();

        if (!$application) {
            return redirect()->back()->with('error', 'No has aplicado a este proyecto');
        }

        $status = $application->pivot->status;

        $volunteer->projects()->detach($project->id);

        return redirect()->back()->with('success', 'Has desistido del proyecto');
    }
}
