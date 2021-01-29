<?php


namespace App\Repositories\TypicalPages\Tools\Work;


class HRDepartmentData extends \App\Repositories\TypicalPages\Tools\AbstractTypicalTool
{
    public static array $rules = [
        'body.hr.title' => 'required|string',
        'body.hr.sub_title' => 'required|string',
        'body.hr.phone' => 'required|string',
        'body.hr.email' => 'required|string',
        'body.hr.photo' => 'required|string',
        'body.hr.name' => 'required|string',
        'body.hr.position' => 'required|string',
    ];

}
