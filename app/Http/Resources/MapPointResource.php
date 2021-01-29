<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapPointResource extends JsonResource
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
            'lng' => floatval($this->longitude),
            'lat' => floatval($this->latitude),
            'store_uid' => $this->store_uid,
            'icon' => $this->mark_image_path,
        ];
    }
}
