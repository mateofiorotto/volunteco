<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{

    protected $fillable = [
        'name', // "Dormitorio", "Comida", etc..
        'enabled'
    ];

    protected $guarded = [
        'id',
    ];

    //una condicion puede pertenecer a muchos proyectos
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
