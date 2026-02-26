<?php

namespace App\Models;

use App\Models\Condition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'location_id',
        'work_hours_per_day',
        'enabled',
        'project_type_id',
        'host_id',
    ];

    protected $guarded = [
        'id',
    ];

    // Cast de fechas
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    //un proyecto puede tener muchas condiciones
    public function conditions()
    {
        return $this->belongsToMany(Condition::class);
    }

    //un proyecto pertenece a un tipo de proyecto
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    //un proyecto pertenece a un host
    public function host()
    {
        return $this->belongsTo(Host::class, 'host_id');
    }

    // voluntarios de un proyecto
    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'project_volunteer')
            ->using(ProjectVolunteer::class)
            ->withPivot('status', 'applied_at', 'accepted_at')
            ->withTimestamps();
    }

    // voluntarios aceptados de un proyecto
    public function acceptedVolunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'project_volunteer')
            ->wherePivot('status', ProjectVolunteer::STATUS_ACCEPTED);
    }

    // localidad del anfitrión
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function scopeWithActiveHost($query)
    {
        return $query->whereHas('host.user', function ($q) {
            $q->where('status', 'activo');
        });
    }

    // Projectos activos con host habilitados
    public function scopePublic($query)
    {
        return $query->enabled()->withActiveHost();
    }

    // Relación con la evalucion del host al voluntario
    public function evaluations()
    {
        return $this->hasMany(VolunteerEvaluation::class);
    }

    // valida que el voluntario este evaluado
    public function hasEvaluationForVolunteer($volunteerId)
    {
        return $this->evaluations()
            ->where('volunteer_id', $volunteerId)
            ->exists();
    }

    // Carga los voluntarios del proyecto y que estan evaluados
    public function registeredVolunteers()
    {
        // Cargar voluntarios con usuario y evaluaciones
        $this->load([
            'volunteers.user',
            'evaluations'
        ]);

        // Mapeo voluntarios, agrego atributo dinámico y ordeno
        return $this->volunteers
            ->map(function ($volunteer) {

                $evaluation = $this->evaluations->firstWhere('volunteer_id', $volunteer->id);
                $volunteer->evaluation = $evaluation;
                $volunteer->is_evaluated = (bool) $evaluation;
                return $volunteer;
            })
            ->sortBy(fn($v) => $v->name);
    }


}
