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

    public function projects()
    {
        return $this->hasManyThrough(Project::class, Location::class);
    }

    // agregar relacion con hosts, voluntarios
}
