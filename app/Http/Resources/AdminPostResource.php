<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPostResource extends JsonResource
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
            'id'              => $this->id,
            'name'            => $this->name,
            'is_published'    => $this->is_published,
            'is_featured'     => $this->is_featured,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
            'taxonomy'        => $this->categories[0] ?? null,
            'cover_file_path' => $this->cover_file_path,
            'body'            => $this->body,
        ];
    }
}
