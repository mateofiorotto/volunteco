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
        'name', //nombre del proyecto del anfitrion (en caso de ser uno solo o nombre de ONG)
        'person_full_name', //nombre y apellido de persona de contacto
        'cuit',
        'linkedin',
        'facebook',
        'instagram',
        'avatar',
        'description',
        'phone',
        'location',
        'notified',
        'notified_at',
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
