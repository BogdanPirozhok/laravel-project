<?php

namespace App\Http\Resources;

use App\Models\Menu;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'id'            => $this->id,
            'menu_name'     => $this->menu_name,
            'menu_position' => $this->menu_position,
            'items'         => Menu::buildTree(MenuItemResource::collection($this->navItems)),
        ];
    }
}
