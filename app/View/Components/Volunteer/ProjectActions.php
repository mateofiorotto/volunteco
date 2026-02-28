<?php

namespace App\View\Components\Volunteer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\VolunteerEvaluation;

class ProjectActions extends Component
{
    public $project;
    public $volunteerStatus;
    public $evaluation;

    /**
     * Create a new component instance.
     */
    public function __construct($project, $volunteerStatus = null)
    {
        //
        $this->project = $project;
        $this->volunteerStatus = $volunteerStatus;

        $user = Auth::user();

        if ($user && $user->volunteer) {
            $this->evaluation = VolunteerEvaluation::where('project_id', $project->id)
                ->where('volunteer_id', $user->volunteer->id)
                ->first();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.volunteer.project-actions');
    }
}
