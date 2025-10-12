<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Host;
use App\Models\Volunteer;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Atributos cambiables con create o update
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'user_type',
        'enabled'
    ];

    /**
     * Campos que no vamos a mostrar cuando convertimos el objeto a array o json
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //agregar relaciones
    /**
     * obtener el perfil de anfitrion de un usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function host(): HasOne
    {
        return $this->hasOne(Host::class);
    }

    /**
     * obtener el perfil de voluntario de un usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function volunteer(): HasOne
    {
        return $this->hasOne(Volunteer::class);
    }
}
