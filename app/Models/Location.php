<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'province_id'];

    // Una localidad pertenece a una provincia
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

}
