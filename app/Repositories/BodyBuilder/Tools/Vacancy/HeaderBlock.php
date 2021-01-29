<?php


namespace App\Repositories\BodyBuilder\Tools\Vacancy;


use App\Repositories\BodyBuilder\Tools\AbstractBlock;

class HeaderBlock extends AbstractBlock
{

    public function render($data)
    {
        return '<span class="vacancy__title">'. $data['caption'] .'</span>';
    }

    public function getSignature()
    {
        return 'header';
    }

    public function getAttributes()
    {
        return ['type', 'caption'];
    }

    public function getPurifyRules()
    {
        return null;
    }
}
