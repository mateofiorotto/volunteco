<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerEvaluation extends Model
{
    //
    protected $fillable = [
        'project_id',
        'volunteer_id',
        'host_id',
        'attitude_score',
        'skills_score',
        'responsibility_score',
        'strengths',
        'improvements',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function getAverageScoreAttribute()
    {
        return round(
            ($this->attitude_score +
             $this->skills_score +
             $this->responsibility_score) / 3,
            2
        );
    }

    public function getPerformanceLabelAttribute()
    {
        $avg = $this->average_score;

        return match (true) {
            $avg >= 1.0 && $avg <= 1.9 => 'Necesita mejorar',
            $avg >= 2.0 && $avg <= 2.9 => 'En crecimiento',
            $avg >= 3.0 && $avg <= 3.9 => 'Bueno',
            $avg >= 4.0 && $avg <= 4.5 => 'Muy bueno',
            $avg >= 4.6 && $avg <= 5.0 => 'Excelente',
            default => null,
        };
    }
}
