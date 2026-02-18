<?php

namespace App\View\Components\Host;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ProjectsVolunteersList extends Component
{
    public $registeredVolunteers;
    public $project;

    /**
     * Create a new component instance.
     */
    public function __construct($registeredVolunteers, $project)
    {
        //
        $this->registeredVolunteers = $registeredVolunteers;
        $this->project = $project;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.host.projects-volunteers-list');
    }
}
