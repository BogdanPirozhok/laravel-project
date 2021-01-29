<?php


namespace App\Repositories\TypicalPages\Tools\Purchases;


class PurchasedNomenclature extends \App\Repositories\TypicalPages\Tools\AbstractTypicalTool
{
    public static array $rules = [
        'body.purchased'   => 'required',
        'body.purchased.*' => 'nullable|string'
    ];

}
