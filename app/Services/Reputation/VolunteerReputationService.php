<?php

namespace App\Services\Reputation;
use App\Models\Volunteer;
use App\Models\VolunteerReputation;

class VolunteerReputationService
{
    /**
     * Create a new class instance.
     */
    public function recalculate(Volunteer $volunteer): void
    {
        // Ratings de evaluaciones
        $averageRating = $volunteer->evaluations()->avg('average_score') ?? 0;
        $totalEvaluations = $volunteer->evaluations()->count();

        // Proyectos
        $completedProjects = $volunteer->projects()
            ->wherePivot('status', 'completado')
            ->count();

        $cancelledProjects = $volunteer->projects()
            ->wherePivot('status', 'cancelado')
            ->count();

        $totalParticipations = $completedProjects + $cancelledProjects;

        // Promedio de proyectos completado sobre participaciones hechas
        $completionRate = $totalParticipations > 0
            ? ($completedProjects / $totalParticipations) * 100
            : 0;

        // Asignación de puntos
        // Puntaje final basado en las evaluaciones (60%) + cantidad de proyectos completados (30%) + promedio de proyectos realizados (10%)
        // La calidad asigna max 60 puntos segun el nivel de evaluación general del voluntario
        $qualityScore = ($averageRating / 5) * 60;
        // La experiencia asigna 4 puntos por proyecto completado hasta un maximo de 30 puntos (8 proyectos como experiencia máxima)
        $experienceScore = min($completedProjects * 4, 30);
        // La confiabilidad asigna hasta 10 puntos segun el porcentaje de proyectos complidos por sobre los cancelados
        $reliabilityScore = ($completionRate / 100) * 10;

        $trustScore = $qualityScore + $experienceScore + $reliabilityScore;

        // Nivel
        $trustLevel = $this->determineLevel(
            $trustScore,
            $completedProjects,
            $completionRate
        );

        // Guardar
        VolunteerReputation::updateOrCreate(
            ['volunteer_id' => $volunteer->id],
            [
                'average_rating' => round($averageRating, 2),
                'total_evaluations' => $totalEvaluations,
                'completed_projects' => $completedProjects,
                'cancelled_projects' => $cancelledProjects,
                'completion_rate' => round($completionRate, 2),
                'trust_score' => round($trustScore, 2),
                'trust_level' => $trustLevel,
            ]
        );
    }

    private function determineLevel($trustScore, $completedProjects, $completionRate): string
    {
        if ($completedProjects < 2) {
            return 'inicial';
        }

        if ($trustScore >= 85 && $completedProjects >= 12 && $completionRate >= 90) {
            return 'embajador';
        }

        if ($trustScore >= 70 && $completedProjects >= 6) {
            return 'destacado';
        }

        if ($trustScore >= 50 && $completedProjects >= 2) {
            return 'activo';
        }

        return 'inicial';
    }
}
