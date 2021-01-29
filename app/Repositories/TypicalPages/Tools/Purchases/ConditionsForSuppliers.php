<?php


namespace App\Repositories\TypicalPages\Tools\Purchases;


class ConditionsForSuppliers extends \App\Repositories\TypicalPages\Tools\AbstractTypicalTool
{
    public static array $rules = [
        'body.conditions'   => 'required',
        'body.conditions.*' => 'nullable|string'
    ];
}
