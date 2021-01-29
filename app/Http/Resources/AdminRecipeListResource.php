<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminRecipeListResource extends JsonResource
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
            'is_published'     => $this->is_published,
            'updated_at'       => $this->updated_at,
            'created_at'       => $this->created_at,
            'primary_category' => $this->primaryCategory[0] ?? null,
        ];
    }
}
