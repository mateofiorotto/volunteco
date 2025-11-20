<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Host;
use App\Models\Project;

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
                $query->latest()->take(5);
            }
        ])->where('user_id', Auth::id())
        ->firstOrFail();

        $lastAppliedVolunteer = null;

        foreach ($host->projects as $project) {
            if (!$project->enabled) {
                continue;
            }

            foreach ($project->volunteers as $volunteer) {
                if ($volunteer->pivot->status !== 'pendiente') {
                    continue;
                }
                $appliedAt = \Carbon\Carbon::parse($volunteer->pivot->applied_at);

                if (!$lastAppliedVolunteer || $appliedAt->gt($lastAppliedVolunteer['applied_at'])) {
                    $lastAppliedVolunteer = [
                        'volunteer' => $volunteer,
                        'project' => $project,
                        'applied_at' => $appliedAt
                    ];
                }
            }
        }

        return view('user.host.dashboard', compact('host', 'lastAppliedVolunteer'));
    }
}
