<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerReputation extends Model
{
    //
    protected $fillable = [
        'volunteer_id',
        'average_rating',
        'total_evaluations',
        'completed_projects',
        'cancelled_projects',
        'completion_rate',
        'trust_score',
        'trust_level',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }
}
