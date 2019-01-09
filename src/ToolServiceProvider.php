<?php

namespace Wehaa\CustomLinks;

use Laravel\Nova\Nova;
use Illuminate\Support\ServiceProvider;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'custom-links');

        $this->publishes([
            __DIR__ . '/../config/custom-links.php' => config_path('custom-links.php')
        ]);
    }
}
