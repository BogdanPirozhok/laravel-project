<?php


namespace App\Repositories\Images;


use Illuminate\Support\ServiceProvider;

class ItdImageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/database/migrations/'
        );

        $this->publishes([
            __DIR__ .'/database/migrations/' => base_path('database/migrations')
        ], 'migrations');

    }
}