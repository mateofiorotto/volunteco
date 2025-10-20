<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{

    protected $fillable = [
        'name', // "Construccion de granjas", "Reforestacion", etc..
        'enabled'
    ];

    protected $guarded = [
        'id',
    ];

    //un tipo de proyecto puede tener muchos proyectos
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    
}
