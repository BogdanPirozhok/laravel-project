<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminShowProductResource extends JsonResource
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
            'image_url'            => $this->image_url,
            'is_published'         => $this->is_published,
            'is_popular'           => $this->is_popular,
            'meta_title'           => $this->meta_title,
            'meta_description'     => $this->meta_description,
            'specs'                => $this->specs,
            'material_title'       => $this->material_title,
            'material_sub_title'   => $this->material_sub_title,
            'material_description' => $this->material_description,
            'material_image_url'   => $this->material_image_url,
            'tags'                 => TruncatedResource::collection($this->tags()->select('id', 'name')->get()),
            'categories'           => $this->categories()->pluck('id'),
            'package'              => TruncatedResource::collection($this->package()->select('id', 'name')->get()),
            'similar_products'     => ProductSimilarResource::collection($this->similarProducts()->get()),
            'similar_recipes'      => ProductSimilarResource::collection($this->similarRecipes()->get()),
            'created_at'           => $this->created_at,
            'updated_at'           => $this->updated_at,
        ];
    }
}
