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
            ->withPivot('status', 'applied_at', 'accepted_at')
            ->withTimestamps();
    }

    // localidad del voluntario
    public function location()
    {
        return $this->belongsTo(Location::class);
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

    // Relación con la evalución del host en el desempeño del proyecto
    public function evaluations()
    {
        return $this->hasMany(VolunteerEvaluation::class);
    }

}
