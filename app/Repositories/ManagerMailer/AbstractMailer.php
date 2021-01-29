<?php


namespace App\Repositories\ManagerMailer;


abstract class AbstractMailer
{
    abstract public function mail($model);

    abstract public function store();


}
