<?php

namespace App\Observers;

use App\Models\VolunteerEvaluation;
use App\Services\Reputation\VolunteerReputationService;

class VolunteerEvaluationObserver
{
    public function created(VolunteerEvaluation $evaluation)
    {
        app(VolunteerReputationService::class)
            ->recalculate($evaluation->volunteer);
    }

}
