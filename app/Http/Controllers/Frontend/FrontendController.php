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
        $projects = Project::where('enabled', true)
            ->with('location.province')
            ->take(3)
            ->latest()
            ->get();

        return view('frontend.home', compact('projects'));
    }

    /**
     * Devolver listado de proyectos con paginación
     */
    public function projects()
    {
        //proyectos activos y con anfitriones activos
        $projects = Project::where('enabled', true)
            ->with('location.province')
            ->latest()
            ->paginate(6);

        return view('frontend.projects', compact('projects'));
    }

    public function projectById($id)
    {
        $project = Project::where('id', $id)->where('enabled', true)->with('volunteers')->firstOrFail();

        //obtener el voluntario asociado al usuario autenticado
        $volunteer = Volunteer::where('user_id', Auth::id())->first();

        $volunteerStatus = null;

        if ($volunteer) {
            // Obtenemos el estado del voluntario en este proyecto
            $pivotRecord = $project->volunteers()
                ->where('volunteer_id', $volunteer->id)
                ->first();

            if ($pivotRecord) {
                $volunteerStatus = $pivotRecord->pivot->status;
            }
        }

        return view('frontend.project-details', compact('project', 'volunteerStatus'));
    }
}
