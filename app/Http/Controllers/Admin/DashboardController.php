<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Host;
use App\Models\Volunteer;

class DashboardController extends Controller
{
    /**
     * Devolver vista de dashboard que muestra los usuarios exceptuando los admin (ultimos 5)
     */
    public function index()
    {
        //users distintos de admin
        $users = User::whereHas('role', function ($query) {$query->where('type', '!=', 'admin');})
            ->get();

        //usuarios activos
        $activeUsers = User::where('status', 'activo')
            ->whereHas('role', function ($query) {$query->where('type', '!=', 'admin');})
            ->count();

        //usuarios hosts
        $hosts = User::whereHas('role', fn($q) => $q->where('type', 'host'))
            ->with('host')
            ->get();

        //5 ultimos
        $hostsLast = $hosts->sortByDesc('created_at')->take(5);

        $hostCount =  Host::count();

        //usuarios voluntarios
        $volunteers = User::whereHas('role', fn($q) => $q->where('type', 'volunteer'))
            ->with('volunteer')
            ->get();

        //5 ultimos
        $volunteersLast = $volunteers->sortByDesc('created_at')->take(5);

        $volunteerCount =  Volunteer::count();

        return view('admin.dashboard', compact(
            'users', 'activeUsers', 'hosts', 'hostCount', 'hostsLast', 'volunteers', 'volunteerCount', 'volunteersLast'
        )
    );
    }
}
