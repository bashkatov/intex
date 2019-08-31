<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Marker extends Model
{
    use SoftDeletes;

    public $fillable = [
        'address',
        'comment',
        'coordinates',
    ];

    public function scopeInBoundedBox($query, $bbox)
    {
        $bbox_array = explode(',', $bbox);
        list($lb_latitude, $lb_longitude, $rt_latitude, $rt_longitude) = $bbox_array;

        $bounding_box = $lb_latitude . ' ' .  $lb_longitude . ',' . $rt_latitude . ' ' . $rt_longitude;

        DB::statement("SET @polygon = ST_Envelope(ST_GeomFromText('LineString({$bounding_box})'))");
        return $query->with(['types'])->selectRaw('id, address, comment, ST_AsGeoJSON(coordinates) as geometry')->whereRaw("ST_CONTAINS(@polygon, coordinates)");
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'marker_has_types');
    }
}
