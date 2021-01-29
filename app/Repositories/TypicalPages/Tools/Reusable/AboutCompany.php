<?php


namespace App\Repositories\TypicalPages\Tools\Reusable;


class AboutCompany extends \App\Repositories\TypicalPages\Tools\AbstractTypicalTool
{
    public static array $rules = [
        'body.about_company'                 => 'required|array',
        'body.about_company.title'           => 'required|string',
        'body.about_company.sub_title'       => 'required|string',
        'body.about_company.image_url'       => 'required|string',
        'body.about_company.buttons'         => 'required|array',
        'body.about_company.buttons.*.title' => 'required|string',
        'body.about_company.buttons.*.url'   => 'required|string',
    ];
}
