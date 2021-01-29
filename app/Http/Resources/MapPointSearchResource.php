<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapPointSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'longitude' => floatval($this->longitude),
            'latitude' => floatval($this->latitude),
            'store_uid' => $this->store_uid,
            'address' => $this->address,

        ];
    }
}
