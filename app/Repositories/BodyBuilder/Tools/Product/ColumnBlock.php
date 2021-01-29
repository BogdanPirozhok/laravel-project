<?php


namespace App\Repositories\BodyBuilder\Tools\Product;


use App\Repositories\BodyBuilder\Tools\AbstractBlock;

class ColumnBlock extends AbstractBlock
{
    public function render($data)
    {
        return '<div class="product__row">' .
            '<span class="product__title">' . $data['caption'] . ':</span>' .
            '<p class="product__description">' .
            $data['value'] .
            '</p></div>';

    }

    public function getSignature()
    {
        return 'column';
    }

    public function getAttributes()
    {
        return [
            'caption', 'value', 'type',
        ];
    }

    public function getPurifyRules()
    {
        return null;
    }
}
