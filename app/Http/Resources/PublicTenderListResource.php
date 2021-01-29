<?php

namespace App\Http\Resources;

use App\Models\Tender;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicTenderListResource extends JsonResource
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
            'id'          => $this->id,
            'type'        => $this->type,
            'name'        => $this->name,
            'unit'        => $this->unit,
            'volume'      => $this->volume,
            'description' => $this->description,
            'deadline'    => $this->when($this->type === Tender::TENDER, $this->deadline),
            'job_file'    => $this->when($this->type === Tender::TENDER, $this->job_description_file_path),
            'work_file'   => $this->when($this->type === Tender::TENDER, $this->job_work_file_path),
        ];
    }
}
