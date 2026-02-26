<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerEvaluation extends Model
{
    //
    protected $fillable = [
        'project_id',
        'volunteer_id',
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

    // Obtengo el promedio de los valores ponderados
    public function getAverageScoreAttribute()
    {
        return round(
            // Valores ponderados
            (
                ($this->attitude_score * 0.40) +
                ($this->skills_score * 0.20) +
                ($this->responsibility_score * 0.40)
            ),
            1
        );
    }

    public function getPerformanceLabelAttribute()
    {
        $avg = $this->average_score;

        return match (true) {
            $avg >= 1.0 && $avg <= 1.9 => 'Necesita mejorar',
            $avg >= 2.0 && $avg <= 2.9 => 'Aceptable',
            $avg >= 3.0 && $avg <= 3.9 => 'Bueno',
            $avg >= 4.0 && $avg <= 4.5 => 'Muy bueno',
            $avg >= 4.6 && $avg <= 5.0 => 'Excelente',
            default => null,
        };
    }
}
