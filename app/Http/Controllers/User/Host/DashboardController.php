<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Host;
use App\Models\Project;
use App\Models\ProjectVolunteer;

class DashboardController extends Controller
{
    /**
     * vista de dashboard de anfitrion
     */
    public function index()
    {
        //$host = Auth::user()->host->load(['projects']);

        $host = Host::with([
            'projects' => function ($query) {
                $query->latest()->take(3);
            }
        ])->where('user_id', Auth::id())
        ->firstOrFail();

        $projectsWithVolunteers = null;
        $lastAppliedVolunteer = null;

        $projectsWithVolunteers = Project::whereHas('host', function ($q) {
                $q->where('user_id', Auth::id()); // Traigo los proyectos de host logeado
            })
            ->where('enabled', true) // solo los proyectos activos
            ->whereHas('volunteers', function ($q) {
                $q->where('project_volunteer.status', ProjectVolunteer::STATUS_PENDING); // que tengan voluntario en estado pendiente
            })
            ->with(['volunteers' => function ($q) {
                $q->where('project_volunteer.status', ProjectVolunteer::STATUS_PENDING) // Carga los voluntarios pendientes
                ->orderBy('project_volunteer.applied_at', 'desc') // y los ordena del mas nuevo al mas viejo
                ->limit(1); // Trae solo el último
            }])
            ->get()
            ->sortByDesc(function ($project) {
                return $project->volunteers->first()->pivot->applied_at ?? null; // Orden apor fecha de aplicado
            })
            ->first(); // Trae el primero de la lista, osea el mas reciente por fecha

        $lastAppliedVolunteer = $projectsWithVolunteers;

        return view('user.host.dashboard', compact('host', 'lastAppliedVolunteer'));
    }
}
