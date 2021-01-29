<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        dd($this->getTranslations());
        return [
            'item_id' => $this->id,
//            'item_caption' => $this->getTranslations('item_caption'),
            'item_caption' => $this->item_caption,
//            'item_description' => $this->getTranslations('item_description'),
            'item_description' => $this->item_description,
            'item_icon' => $this->item_icon,
            'item_target' => $this->item_target,
            'item_url' => $this->item_url,
            'item_menu_id' => $this->item_menu_id,
            'item_parent' => $this->item_parent,
            'order' => $this->order,
            'children' => $this->when(isset($this->children), $this->children, []),
        ];
    }
}
