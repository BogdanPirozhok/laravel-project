<?php


namespace App\Repositories\BodyBuilder\Tools;


abstract class AbstractBlock
{
    public abstract function render($data);

    public abstract function getSignature();

    public abstract function getAttributes();

    public abstract function getPurifyRules();
}
