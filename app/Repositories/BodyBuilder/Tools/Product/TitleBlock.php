<?php


namespace App\Repositories\BodyBuilder\Tools\Product;


use App\Repositories\BodyBuilder\Tools\AbstractBlock;

class TitleBlock extends AbstractBlock
{

    public function render($data)
    {
        return '<h3>' . $data['value'] . '<h3>';
    }

    public function getSignature()
    {
        return 'title';
    }

    public function getAttributes()
    {
        return ['value', 'type'];
    }

    public function getPurifyRules()
    {
        return null;
    }
}
