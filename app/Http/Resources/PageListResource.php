<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'slug'             => $this->slug,
            'title'            => $this->title,
            'is_published'     => $this->is_published,
            'essential'        => $this->essential,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}
