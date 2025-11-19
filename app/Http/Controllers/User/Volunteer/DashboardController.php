<?php

namespace App\Http\Controllers\User\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class DashboardController extends Controller
{
    /**
     * Dashboard del voluntario
     */
    public function index()
    {
        $volunteer = Auth::user()->volunteer;

        //ultimos 6 proyectos a los que aplicó el voluntario
        $appliedProjects = $volunteer->projects()
            ->withPivot('status', 'applied_at', 'accepted_at')
            ->orderByPivot('applied_at', 'desc')
            ->take(6)
            ->get();

        //ultimos 3 proyectos publicados en general
        $latestProjects = Project::where('enabled', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('user.volunteer.dashboard', compact('appliedProjects', 'latestProjects'));
    }
}
