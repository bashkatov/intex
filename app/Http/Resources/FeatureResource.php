<?php

namespace App\Http\Resources;

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
                'id' => $this->id,
                'comment' => $this->comment,
                'types' => $this->types,
            ],
        ];
    }
}
