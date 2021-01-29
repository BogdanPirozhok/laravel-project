<?php


namespace App\Repositories\BodyBuilder\Tools\Vacancy;


use App\Repositories\BodyBuilder\Tools\AbstractBlock;

class DashedBlock extends AbstractBlock
{

    public function render($data)
    {
        return '<div class="dashed"></div>';
    }

    public function getSignature()
    {
       return 'dashed';
    }

    public function getAttributes()
    {
        return ['type'];
    }

    public function getPurifyRules()
    {
        return null;
    }
}
