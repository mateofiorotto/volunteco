<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];

    // Una provincia tiene muchas localidades
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    // agregar relacion con hosts, voluntarios y proyectos
}
