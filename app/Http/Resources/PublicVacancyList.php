<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicVacancyList extends JsonResource
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
            'id'      => $this->id,
            'name'    => $this->name,
            'city'    => $this->city,
            'payment' => $this->payment,
            'link'    => route('public.vacancy.view', ['vacancy' => $this->id])
        ];
    }
}
