<?php

namespace App\PageBuilder;

use Illuminate\Support\ServiceProvider;

class PageBuilderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/pagebuilder.php', 'pagebuilder'
        );
    }

    public function boot()
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        // Load views
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'pagebuilder');

        // Publish config
        $this->publishes([
            __DIR__.'/Config/pagebuilder.php' => config_path('pagebuilder.php'),
        ], 'pagebuilder-config');

        // Publish assets
        $this->publishes([
            __DIR__.'/Resources/js' => public_path('js/page-builder'),
        ], 'pagebuilder-assets');
    }
} 