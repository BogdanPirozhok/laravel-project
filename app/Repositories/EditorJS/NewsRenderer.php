<?php


namespace App\Repositories\EditorJS;


use App\Repositories\EditorJS\Tools\Delimiter;
use App\Repositories\EditorJS\Tools\Header;
use App\Repositories\EditorJS\Tools\Image;
use App\Repositories\EditorJS\Tools\Lists;
use App\Repositories\EditorJS\Tools\Paragraph;
use App\Repositories\EditorJS\Tools\Quote;
use App\Repositories\EditorJS\Tools\Warning;

class NewsRenderer extends AbstractRenderer
{

    public function __construct()
    {
        parent::__construct();

        $this->addTools([
            Header::class,
            Paragraph::class,
            Quote::class,
            Lists::class,
            Image::class,
            Delimiter::class,
            Warning::class,
        ]);
    }
}
