<?php


namespace App\Repositories\TypicalPages\Tools\Reusable;


use App\Repositories\TypicalPages\Tools\AbstractTypicalTool;

/**
 * Same as PageHeaderTypicalTool but nullable
 *
 * Class NullablePageHeaderTypicalTool
 * @package App\Repositories\TypicalPages\Tools\Reusable
 */
class NullablePageHeaderTypicalTool extends AbstractTypicalTool
{
    public static array $rules = [
        'body.header'             => 'sometimes|array',
        'body.header.title'       => 'sometimes|string',
        'body.header.sub_title'   => 'nullable|string',
        'body.header.button_url'  => 'nullable|string',
        'body.header.button_text' => 'nullable|string',
        'body.header.image_url'   => 'nullable|string',
    ];
}
