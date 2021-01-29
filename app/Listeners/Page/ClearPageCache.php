<?php

namespace App\Listeners\Page;

use App\Events\Page\PageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class ClearPageCache
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PageEvent $event)
    {
        Cache::forget('page_' . $event->page->slug);
    }
}
