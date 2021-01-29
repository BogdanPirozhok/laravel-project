<?php


namespace App\Repositories\TypicalPages\Tools\Quality;


class QualityServicePhoneTypicalTool extends \App\Repositories\TypicalPages\Tools\AbstractTypicalTool
{
    public static array $rules = [
        'body.qs.phone' => 'required|string'
    ];

}
