<?php


namespace App\Repositories\TypicalPages\Tools\Reusable;


use App\Repositories\TypicalPages\Tools\AbstractTypicalTool;

class MetaTypicalTool extends AbstractTypicalTool
{
    public static array $rules = [
        'title'            => 'required|string',
        'description'      => 'nullable|string',
        'meta_title'       => 'nullable|string',
        'meta_description' => 'nullable|string',
    ];
}
