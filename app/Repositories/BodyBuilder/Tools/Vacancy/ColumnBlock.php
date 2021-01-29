<?php


namespace App\Repositories\BodyBuilder\Tools\Vacancy;


use App\Repositories\BodyBuilder\Tools\AbstractBlock;

class ColumnBlock extends AbstractBlock
{

    public function render($data)
    {
        return '<div class="vacancy__row"><span class="vacancy__text vacancy__text--fw-500">' .$data['caption'] .':</span> <span class="vacancy__text">'. $data['value'] .'</span></div>';
    }

    public function getSignature()
    {
        return 'column';
    }

    public function getAttributes()
    {
        return ['type', 'caption', 'value'];
    }

    public function getPurifyRules()
    {
        return null;
    }
}
