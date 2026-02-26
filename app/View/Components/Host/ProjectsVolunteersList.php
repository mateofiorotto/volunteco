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
    public $pending;
    public $rejected;
    public $accepted;
    public $finished;
    public $inProject;

    /**
     * Create a new component instance.
     */
    public function __construct($registeredVolunteers, $project)
    {
        //
        $this->registeredVolunteers = $registeredVolunteers;
        $this->project = $project;

        $this->pending = $registeredVolunteers->filter(function ($volunteer) {
            return $volunteer->pivot->isPending();
        });

        $this->rejected = $registeredVolunteers->filter(function ($volunteer) {
            return $volunteer->pivot->isRejected();
        });

        $this->accepted = $registeredVolunteers->filter(function ($volunteer) {
            return $volunteer->pivot->isAccepted();
        });

        $this->finished = $registeredVolunteers->filter(function ($volunteer){
            return $volunteer->pivot->isFinished();
        });

        $this->inProject = $registeredVolunteers->filter(function ($volunteer) {
            return $volunteer->pivot->isAccepted()
                || $volunteer->pivot->isFinished();
        });

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.host.projects-volunteers-list');
    }
}
