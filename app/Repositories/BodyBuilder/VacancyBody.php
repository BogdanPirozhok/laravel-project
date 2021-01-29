<?php


namespace App\Repositories\BodyBuilder;


use App\Repositories\BodyBuilder\Tools\Vacancy\ColumnBlock;
use App\Repositories\BodyBuilder\Tools\Vacancy\DashedBlock;
use App\Repositories\BodyBuilder\Tools\Vacancy\HeaderBlock;

class VacancyBody
{
    public BodyBuilder $instance;

    /**
     * VacancyBody constructor.
     * @param array $blocks
     * @throws Exceptions\BodyBuilderException
     */
    public function __construct(array $blocks)
    {
        $this->instance = new BodyBuilder($blocks,
            [
                HeaderBlock::class,
                ColumnBlock::class,
                DashedBlock::class
            ]
        );
    }
}
