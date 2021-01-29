<?php

namespace App\Providers;

use App\Events\Menu\MenuDeleted;
use App\Events\Menu\MenuSaved;
use App\Events\Page\PageDeleted;
use App\Events\Page\PageSaved;
use App\Listeners\Menu\ClearMenuCache;
use App\Listeners\Page\ClearPageCache;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MenuDeleted::class => [
            ClearMenuCache::class
        ],
        MenuSaved::class => [
            ClearMenuCache::class
        ],
        PageDeleted::class => [
            ClearPageCache::class,
        ],
        PageSaved::class => [
            ClearPageCache::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
