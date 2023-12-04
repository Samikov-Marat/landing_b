<?php

namespace App\Providers\Classes\Amo;


use App\Classes\Site\Amo\AmoSenderVelocity;
use Illuminate\Support\ServiceProvider;

class AmoSenderVelocityProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AmoSenderVelocity::class, function () {
            return new AmoSenderVelocity();
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
