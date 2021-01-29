<?php


namespace App\Repositories\TypicalPages\Tools\Reusable;

use App\Repositories\TypicalPages\Tools\AbstractTypicalTool;

/**
 * Tool for contact block; Landing and About pages;
 *
 * Class ContactsListTypicalTool
 * @package App\Repositories\TypicalPages\Tools
 */
class ContactsListTypicalTool extends AbstractTypicalTool
{
    public static array $rules = [
        'body.contacts'             => 'required|array',
        'body.contacts.*.title'     => 'required|string',
        'body.contacts.*.sub_title' => 'sometimes|string',
        'body.contacts.*.phone'     => 'required_without:body.contacts.*.email|string',
        'body.contacts.*.email'     => 'required_without:body.contacts.*.phone|string',
    ];
}
