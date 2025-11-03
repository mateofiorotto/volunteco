<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Host;
use App\Models\Volunteer;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $users = User::whereHas('role', function ($query) {$query->where('type', '!=', 'admin');})
            ->get();

        $activeUsers = User::where('status', 'activo')
            ->whereHas('role', function ($query) {$query->where('type', '!=', 'admin');})
            ->count();

        $hosts = User::whereHas('role', fn($q) => $q->where('type', 'host'))
            ->with('host')
            ->get();

        $hostsLast = $hosts->sortByDesc('created_at')->take(5);

        $hostCount =  Host::count();

        $volunteers = User::whereHas('role', fn($q) => $q->where('type', 'volunteer'))
            ->with('volunteer')
            ->get();

        $volunteersLast = $volunteers->sortByDesc('created_at')->take(5);

        $volunteerCount =  Volunteer::count();

        return view('admin.dashboard', compact(
            'users', 'activeUsers', 'hosts', 'hostCount', 'hostsLast', 'volunteers', 'volunteerCount', 'volunteersLast'
        )
    );
    }
}
