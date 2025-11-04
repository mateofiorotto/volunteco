<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Volunteer;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend/home');
    }

    /**
     * Devolver listado de proyectos con paginación
     */
    public function projects()
    {
        //proyectos activos y con anfitriones activos
         $projects = Project::where('enabled', true)
        ->whereHas('host.user', function($query) {
            $query->where('status', 'activo');
        })
        ->latest()
        ->paginate(6);

        return view('frontend/projects', compact('projects'));
    }

    public function projectById($id)
    {
        $project = Project::where('id', $id)->where('enabled', true)->firstOrFail();

        //obtener el voluntario asociado al usuario autenticado
        $volunteer = Volunteer::where('user_id', auth()->id())->first();

        $hasApplied = false;

        if ($volunteer) {
            $hasApplied = $project->volunteers()
                ->where('volunteer_id', $volunteer->id)
                ->exists();
        }


        return view('frontend/project-details', compact('project', 'hasApplied'));
    }
}
