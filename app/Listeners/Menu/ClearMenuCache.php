<?php

namespace App\Listeners\Menu;

use App\Events\Menu\MenuEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class ClearMenuCache
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
     * @param MenuEvent $event
     * @return void
     */
    public function handle(MenuEvent $event)
    {
        $array = config('menu.list');

        foreach ($array as $item) {
            Cache::forget($item);
        }
    }
}
