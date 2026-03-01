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
        'average_score',
        'strengths',
        'improvements',
    ];

    // evento que calcula el promedio ponderado
    protected static function booted()
    {
        static::saving(function ($evaluation) {
            $evaluation->average_score = round(
                (
                    ($evaluation->attitude_score * 0.40) +
                    ($evaluation->skills_score * 0.20) +
                    ($evaluation->responsibility_score * 0.40)
                ),
                2
            );
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
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
