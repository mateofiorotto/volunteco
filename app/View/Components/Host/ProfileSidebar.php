<?php

namespace App\View\Components\Host;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ProfileSidebar extends Component
{
    public $project;
    public $isAceptedByHost;
    public $isInHostRoster;

    /**
     * Create a new component instance.
     */
    public function __construct($project, $isAceptedByHost = false, $isInHostRoster = null)
    {
        //
        $this->project = $project;
        $this->isAceptedByHost = $isAceptedByHost;
        $this->isInHostRoster = $isInHostRoster;
    }

    public function isVolunteer()
    {
        return Auth::check() && Auth::user()->hasRole('volunteer');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.host.profile-sidebar');
    }
}
