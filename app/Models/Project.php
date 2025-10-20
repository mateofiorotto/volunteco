<?php

namespace App\Models;

use App\Models\Condition;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'location',
        'work_hours_per_day',
        'enabled',
        'project_type_id',
        'host_id',
    ];

    protected $guarded = [
        'id',
    ];

    //un proyecto puede tener muchas condiciones
    public function conditions()
    {
        return $this->belongsToMany(Condition::class);
    }

    //un proyecto pertenece a un tipo de proyecto
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    //un proyecto pertenece a un host
    public function host()
    {
        return $this->belongsTo(Host::class, 'host_id');
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'project_volunteer')
            ->withPivot('status', 'applied_at', 'accepted_at')
            ->withTimestamps();
    }
}
