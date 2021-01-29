<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                   => $this->id,
            'name'                 => $this->name,
            'slug'                 => $this->slug,
            'specs'                => $this->specs,
            'image_url'            => $this->image_url,
            'is_popular'           => $this->is_popular,
            'is_published'         => $this->is_published,
            'material_title'       => $this->material_title,
            'material_sub_title'   => $this->material_sub_title,
            'material_description' => $this->material_description,
            'material_image_url'   => $this->material_description
        ];
    }
}
