<?php

namespace App\Providers;

use App\Classes\Site\Metrics;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class MetricsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('metrics', function (Application $app){
            return new Metrics(config('database.redis.vmagent'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
