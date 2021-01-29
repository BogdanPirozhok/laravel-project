<?php


namespace App\Repositories\Images;


class ImageableHandler
{

    public $image;
    public ImageableHandler $handler;

    public function __construct(ImageableHandler $handler, $image)
    {
        $this->image = $image;
        $this->handler = $handler;
    }

}