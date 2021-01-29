<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminProductListResource extends JsonResource
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
            'id'               => $this->id,
            'name'             => $this->name,
            'slug'             => $this->slug,
            'image_url'        => $this->image_url,
            'is_popular'       => $this->is_popular,
            'is_published'     => $this->is_published,
            'primary_category' => $this->primaryCategory[0] ?? null
        ];
    }
}
