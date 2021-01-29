<?php


namespace App\Repositories\Category;


use App\Repositories\Category\Interfaces\UriBuilder;
use Illuminate\Database\Eloquent\Model;

class UriHandler
{
    private UriBuilder $builder;
    private Model $context;
    private string $model;
    private $params;

    public function __construct(UriBuilder $builder, $context, string $model, $params = null)
    {
        $this->builder = $builder;
        $this->context = $context;
        $this->model   = $model;
        $this->params  = $params;
    }

    public function execute()
    {
        return $this->builder->handle($this->context, $this->model, $this->params);
    }
}