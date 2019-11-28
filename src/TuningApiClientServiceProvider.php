<?php

namespace BcConsulting\TuningApiClient;

use Illuminate\Support\ServiceProvider;

class TuningApiClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/../config/tuning-api-client.php' => config_path('tuning-api-client.php')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->mergeConfigFrom(__DIR__.'/../config/tuning-api-client.php', 'tuning-api-client');

        $this->app->singleton('tuning-api-client', function ($app) {
            return new TuningApiClient($app['config']->get('tuning-api-client'));
        });
    }
}
