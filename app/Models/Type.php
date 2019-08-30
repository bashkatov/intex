<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function markers()
    {
        return $this->belongsToMany(Marker::class, 'marker_has_types');
    }
}
