<?php


namespace App\Repositories\TypicalPages\Tools\Categories;


class ProductSliderTypicalTool extends \App\Repositories\TypicalPages\Tools\AbstractTypicalTool
{
    public static array $rules = [
        'body.product_slider'           => 'required',
        'body.conditions.*.title'       => 'required|string',
        'body.conditions.*.description' => 'required|string',
        'body.conditions.*.src'         => 'required|string',
        'body.conditions.*.url'         => 'required|string',
    ];
}
