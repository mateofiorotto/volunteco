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
        'location',
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
}
