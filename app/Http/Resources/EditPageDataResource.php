<?php

namespace App\Http\Resources;

use App\Helpers\LocaleHelper;
use App\Models\Template;
use Illuminate\Http\Resources\Json\JsonResource;

class EditPageDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'page' => parent::toArray($request),
            'templates' => TemplateResource::collection(Template::all()),
            'locales' => LocaleHelper::locales(),
        ];
    }
}
