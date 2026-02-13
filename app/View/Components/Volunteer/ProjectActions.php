<?php

namespace App\View\Components\Volunteer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectActions extends Component
{
    public $project;
    public $volunteerStatus;

    /**
     * Create a new component instance.
     */
    public function __construct($project, $volunteerStatus = null)
    {
        //
        $this->project = $project;
        $this->volunteerStatus = $volunteerStatus;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.volunteer.project-actions');
    }
}
