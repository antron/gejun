<?php

namespace Antron\Gejun;

use Illuminate\Support\ServiceProvider;

class GejunServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/gejun.php' => config_path('gejun.php'),
                ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('gejun', function($app) {
            return new Gejun;
        });


        $this->mergeConfigFrom(
                __DIR__ . '/config/gejun.php', 'gejun'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['gejun'];
    }

}
