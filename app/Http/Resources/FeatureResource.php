<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'       => 'Feature',
            'geometry'   => collect(json_decode($this->geometry)),
            'properties' => [
                'id'           => $this->id,
                'created_date' => Carbon::createFromTimeString($this->created_at)->format('d.m.Y'),
                'comment'      => $this->comment ?: '',
                'types'        => $this->types,
            ],
        ];
    }
}
