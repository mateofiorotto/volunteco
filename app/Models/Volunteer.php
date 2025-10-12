<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'user_id'
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
    
}
