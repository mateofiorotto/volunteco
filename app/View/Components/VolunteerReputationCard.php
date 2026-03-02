<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Volunteer;

class VolunteerReputationCard extends Component
{
    public Volunteer $volunteer;

    /**
     * Create a new component instance.
     */
    public function __construct(Volunteer $volunteer)
    {
        //
        $this->volunteer = $volunteer;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.volunteer-reputation-card');
    }
}
