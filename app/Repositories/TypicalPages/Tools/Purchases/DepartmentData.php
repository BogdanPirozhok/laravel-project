<?php


namespace App\Repositories\TypicalPages\Tools\Purchases;


class DepartmentData extends \App\Repositories\TypicalPages\Tools\AbstractTypicalTool
{
    public static array $rules = [
        'body.department.phone' => 'required|string',
        'body.department.email' => 'required|string',
    ];

}
