<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $users = \App\Models\User::whereHas('role', function ($query) {$query->where('type', '!=', 'admin');})
            ->get();
        $activeUsers = \App\Models\User::where('status', 'activo')
            ->whereHas('role', function ($query) {$query->where('type', '!=', 'admin');})
            ->count();
        $hostUsers =  \App\Models\Host::count();
        $volunteerUsers =  \App\Models\Volunteer::count();

        return view('admin.dashboard', [
            'users' => $users,
            'activeUsers' => $activeUsers,
            'hostCount' => $hostUsers,
            'volunteerCount' => $volunteerUsers
        ]);
    }
}
