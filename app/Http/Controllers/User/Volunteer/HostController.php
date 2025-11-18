<?php

namespace App\Http\Controllers\User\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Host;
use Illuminate\Support\Facades\Gate;
use App\Models\Volunteer;

class HostController extends Controller
{
    //
    public function profile($id)
    {
        $host = Host::with(['user'])->findOrFail($id);

        if (Gate::denies('view', $host)) {
            return redirect()->route('volunteer.projects.applied')->with('error', 'No tienes permiso para ver el perfil del usuario solicitado.');
        }

        return view('user.volunteer.hosts.profile', compact('host'));
    }
}
