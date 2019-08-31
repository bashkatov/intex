<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $hidden = ['created_at', 'updated_at', 'deleted_at', 'pivot'];

    public function markers()
    {
        return $this->belongsToMany(Marker::class, 'marker_has_types');
    }
}
