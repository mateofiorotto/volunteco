<?php

namespace App\Http\Controllers\User\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Volunteer;
use App\Models\ProjectVolunteer;

class DashboardController extends Controller
{
    /**
     * Dashboard del voluntario
     */
    public function index()
    {
        $volunteer = Auth::user()->volunteer;

        //ultimos 6 proyectos a los que aplicó el voluntario
        $activeProjects = $volunteer->activeProjects()
            ->orderByPivot('applied_at', 'desc')
            ->take(6)
            ->get();

        //ultimos 3 proyectos publicados en general
        $latestProjects = Project::public()
            ->whereDoesntHave('volunteers', function ($q) {
                $q->where('volunteer_id', Auth::user()->volunteer->id);
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('user.volunteer.dashboard', compact('activeProjects', 'latestProjects'));
    }
}
