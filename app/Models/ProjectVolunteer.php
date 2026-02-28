<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class ProjectVolunteer extends Pivot
{
    //
    protected $table = 'project_volunteer';

    const STATUS_PENDING = 'pendiente';
    const STATUS_ACCEPTED = 'aceptado';
    const STATUS_REJECTED = 'rechazado';
    const STATUS_COMPLETED = 'completado';
    const STATUS_CANCELED = 'cancelado';

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isAccepted()
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCanceled()
    {
        return $this->status === self::STATUS_CANCELED;
    }

    public function isFinished()
    {
        return $this->isCompleted() || $this->isCanceled();
    }

    public function getStatusClassAttribute()
    {
        return Str::slug($this->status, '_');
    }

}
