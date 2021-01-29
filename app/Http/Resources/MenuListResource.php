<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuListResource extends JsonResource
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
            'menu_name' => $this->menu_name,
        ];
    }
}
