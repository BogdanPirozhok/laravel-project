<?php

namespace App\Http\Resources;

use App\Repositories\EditorJS\EditorJsRenderer;
use App\Repositories\EditorJS\NewsRenderer;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $array         = parent::toArray($request);
        $delimiter     = '<figure><div class="block-delimiter"></div></figure>';
        $array['body'] = NewsRenderer::render($this->body);
        $content       = explode($delimiter, $array['body']);

        if ( count($content) > 1) {
            $array['body']       = array_shift($content);
            $array['additional'] = implode($delimiter, $content);
        }

        return $array;
    }
}
