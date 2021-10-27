<?php

namespace Converter\WebpConverter;

use Converter\WebpConverter\Contracts\Converter;
use Converter\WebpConverter\Services\WebpConverter;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Converter::class, WebpConverter::class);
    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config.php', 'webp');
        $this->loadRoutesFrom(__DIR__ . '/web.php');
        $this->loadViewsFrom(__DIR__ . "/views", "webp");

        $this->publishes([
            __DIR__ . '/config.php' => config_path('webp.php')
        ], 'webp-config');
    }
}