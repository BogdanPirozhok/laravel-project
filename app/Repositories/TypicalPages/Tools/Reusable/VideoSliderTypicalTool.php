<?php


namespace App\Repositories\TypicalPages\Tools\Reusable;


use App\Repositories\TypicalPages\Tools\AbstractTypicalTool;

class VideoSliderTypicalTool extends AbstractTypicalTool
{
    public static array $rules = [
        'body.video'               => 'required|array',
        'body.video.*.video_url'   => 'required|string',
        'body.video.*.preview_url' => 'required|string',
    ];
}
