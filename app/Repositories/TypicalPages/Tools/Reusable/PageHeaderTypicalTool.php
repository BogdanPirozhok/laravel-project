<?php


namespace App\Repositories\TypicalPages\Tools\Reusable;

use App\Repositories\TypicalPages\Tools\AbstractTypicalTool;

/**
 * Page header tool; This used almost on all pages
 *
 * Class PageHeaderTypicalTool
 * @package App\Repositories\TypicalPages\Tools
 */
class PageHeaderTypicalTool extends AbstractTypicalTool
{
    public static array $rules = [
        'body.header'             => 'required|array',
        'body.header.title'       => 'required|string',
        'body.header.sub_title'   => 'nullable|string',
        'body.header.button_url'  => 'nullable|string',
        'body.header.button_text' => 'nullable|string',
        'body.header.image_url'   => 'nullable|string',
    ];
}
