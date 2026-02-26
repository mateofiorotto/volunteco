<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

/**
 * Clase de VOLUNTARIOS
 */
class Volunteer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'lastname',
        'dni',
        'birthdate',
        'educational_level',
        'profession',
        'linkedin',
        'facebook',
        'instagram',
        'avatar',
        'biography',
        'phone',
        'location_id',
        'user_id',
        'disabled_at',
    ];

    /**
     * No se puede actualizar los sig. campos
     */
    protected $guarded = [
        'id',
        'created_at',
    ];

    // Cast de fechas
    protected $casts = [
        'birthdate' => 'datetime'
    ];

    /**
     * FK a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_volunteer')
            ->using(ProjectVolunteer::class)
            ->withPivot('status', 'applied_at', 'accepted_at')
            ->withTimestamps();
    }

    // localidad del voluntario
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Relación con la evalución del host en el desempeño del proyecto
    public function evaluations()
    {
        return $this->hasMany(VolunteerEvaluation::class);
    }


    // Accessor para nombre completo
    // https://laravel.com/docs/12.x/eloquent-mutators
    protected function fullName(): Attribute
    {
        return Attribute::get(function () {
            return trim("{$this->name} {$this->lastname}");
        });
    }

    protected $appends = ['full_name'];

    // Metodo para chequear si el voluntario esta aceptado en algun proyecto del host
    public function isHostAcepted($hostId)
    {
        return $this->projects()
            ->where('projects.host_id', $hostId)
            ->wherePivotIn('status', ['aceptado'])
            ->exists();
    }

    /**
     * Chequea si el voluntario está en la nómina de algún proyecto del host
     * Esto incluye proyectos donde está aceptado o pendiente
     */
    public function isInHostRoster($hostId)
    {
        return $this->projects()
            ->where('projects.host_id', $hostId)
            ->wherePivotIn('status', ['aceptado', 'pendiente'])
            ->exists();
    }

    // Promedio global de evaluaciones
    public function getGlobalAverageScoreAttribute()
    {
        if ($this->evaluations->isEmpty()) {
            return null;
        }

        return round(
            $this->evaluations()
                ->selectRaw('AVG((attitude_score * 0.40) + (skills_score * 0.20) + (responsibility_score * 0.40)) as avg_score')
                ->value('avg_score'),
            1
        );
    }

    public function getGlobalPerformanceLabelAttribute()
    {
        $avg = $this->global_average_score;

        if (!$avg) return null;

        return match (true) {
            $avg <= 1.9 => 'Necesita mejorar',
            $avg <= 2.9 => 'Aceptable',
            $avg <= 3.9 => 'Bueno',
            $avg <= 4.5 => 'Muy bueno',
            default => 'Excelente',
        };
    }


}
