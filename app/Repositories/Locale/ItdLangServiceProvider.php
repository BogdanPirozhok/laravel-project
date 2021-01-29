<?php

namespace App\Repositories\Locale;

use App\Repositories\Locale\Http\Middleware\Localization;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ItdLangServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ .  '/Config/locale.languages.php', 'locale.languages');
    }

    /**
     * @param Router $router
     */
    public function boot(Router $router)
    {
        $this->addMiddleware($router);

        $this->addTranslations();
    }


    /**
     * Adding middleware
     *
     * @param Router $router
     */
    private function addMiddleware(Router $router)
    {
//        $router->aliasMiddleware('locale', Localization::class);

        $router->pushMiddlewareToGroup('web', Localization::class);
    }


    /**
     * Adding locales
     */
    private function addTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'locale');
    }
}
