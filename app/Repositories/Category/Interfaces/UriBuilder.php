<?php


namespace App\Repositories\Category\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface UriBuilder
{
    public function handle(Model $context, string $model, string $params = null);
}