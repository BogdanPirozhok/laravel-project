<?php


namespace App\Repositories\BodyBuilder;


use App\Repositories\BodyBuilder\Tools\Product\ColumnBlock;
use App\Repositories\BodyBuilder\Tools\Product\TitleBlock;
use App\Repositories\BodyBuilder\Tools\Product\Warn;

class ProductBody
{
    public BodyBuilder $instance;

    /**
     * ProductBody constructor.
     * @param array $blocks
     * @throws Exceptions\BodyBuilderException
     */
    public function __construct(array $blocks)
    {
        $this->instance = new BodyBuilder($blocks,
            [
                ColumnBlock::class,
                TitleBlock::class,
                Warn::class,
            ]
        );
    }

}
