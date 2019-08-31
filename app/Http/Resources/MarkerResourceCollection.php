<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MarkerResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'     => 'FeatureCollection',
            'features' => FeatureResource::collection($this->collection),
        ];
    }

    public function withResponse($request, $response)
    {
        $response
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT)
            ->withCallback($request->input('callback'));
    }
}
