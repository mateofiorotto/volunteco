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
        'full_name',
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
        'location',
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

    /**
     * Modifico el formato de la fecha de nacimiento.
     * fuente: https://laravel.com/docs/12.x/eloquent-mutators#defining-an-accessor
     */
    protected function birthdate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null
        );
    }

}
