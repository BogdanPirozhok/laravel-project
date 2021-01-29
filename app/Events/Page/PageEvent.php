<?php


namespace App\Events\Page;


use App\Models\Page;

abstract class PageEvent
{
    /**
     * @var Page
     */
    public Page $page;

    /**
     * PageEvent constructor.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }
}
