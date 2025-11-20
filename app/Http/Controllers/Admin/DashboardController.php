<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Host;
use App\Models\Project;
use App\Models\Volunteer;

class DashboardController extends Controller
{
    /**
     * Devolver vista de dashboard que muestra los usuarios exceptuando los admin (ultimos 5)
     */
    public function index()
    {

        //5 ultimos
        $hostsLast = Host::with('user')->latest()->take(5)->get();

        $hostCount =  Host::count();

        //5 ultimos
        $volunteersLast = Volunteer::with('user')->latest()->take(5)->get();

        $volunteerCount =  Volunteer::count();

        $projectsLast = Project::latest()->take(5)->get();

        $projectsCount = Project::count();

        return view(
            'admin.dashboard',
            compact('hostCount', 'hostsLast', 'volunteerCount', 'volunteersLast', 'projectsLast', 'projectsCount')
        );
    }
}
