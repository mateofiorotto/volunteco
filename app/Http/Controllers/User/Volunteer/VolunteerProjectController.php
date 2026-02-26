<?php

namespace App\Http\Controllers\User\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Volunteer;
use App\Models\ProjectVolunteer;

class VolunteerProjectController extends Controller
{
    /**
     * Mostrar lista de proyectos a los que el voluntario ha aplicado
     * Pasamos el parametro en el paginador para que no se pisen los valores
     */
    public function volunteerAppliedProjects()
    {
        $volunteer = Auth::user()->volunteer;

        $projects = $volunteer->projects()->paginate(10);

        return view('user.volunteer.projects.applied', compact('projects'));
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

        $volunteer->projects()->syncWithoutDetaching([
            $project->id => [
                'status' => ProjectVolunteer::STATUS_PENDING,
                'applied_at' => now(),
            ]
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
