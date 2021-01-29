<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminShowRecipeResource extends JsonResource
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
            'body'             => $this->body,
            'ingredients'      => $this->ingredients,
            'image_url'        => $this->image_url,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'complexity'       => $this->complexity,
            'cooking_time'     => $this->cooking_time,
            'servings'         => $this->servings,
            'is_published'     => $this->is_published,
            'slug'             => $this->slug,
            'updated_at'       => $this->updated_at,
            'created_at'       => $this->created_at,
            'categories'       => $this->categories()->pluck('id'),
        ];
    }
}
