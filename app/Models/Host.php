<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase de ANFITRIONES
 */
class Host extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', //nombre del anfitrion (en caso de ser uno solo o nombre de ONG)
        'person_full_name', //nombre y apellido de persona de contacto
        'cuit',
        'linkedin',
        'facebook',
        'instagram',
        'avatar',
        'description',
        'phone',
        'location_id',
        'disabled_at',
        'rejection_reason',
        'user_id'
    ];

    /**
     * No se puede actualizar los sig. campos
     */
    protected $guarded = [
        'id',
        'created_at',
    ];

    protected $casts = [
        'disabled_at' => 'datetime',
    ];

    /**
     * FK a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //un anfitrion puede tener muchos proyectos
    public function projects()
    {
        return $this->hasMany(Project::class, 'host_id');
    }

    // localidad del anfitrión
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Método para chequear si el voluntario esta aceptado en algun proyecto del host
    public function hasVolunteer($volunteerId)
    {
        return $this->projects()
            ->whereHas('volunteers', function ($query) use ($volunteerId) {
                $query->where('volunteer_id', $volunteerId)
                    ->whereIn('project_volunteer.status', [ProjectVolunteer::STATUS_ACCEPTED]);
            })
            ->exists();
    }

    // Método para obtener el o los proyectos donde esta aceptado el voluntario
    public function projectsWithVolunteer($volunteerId)
    {
        return $this->projects()
            ->whereHas('volunteers', function ($query) use ($volunteerId) {
                $query->where('volunteer_id', $volunteerId);
            })
            ->with(['volunteers' => function ($query) use ($volunteerId) {
                $query->where('volunteer_id', $volunteerId);
            },
            'evaluations' => function ($query) use ($volunteerId) {
                $query->where('volunteer_id', $volunteerId);
            }
            ])
            ->get();
    }
}
