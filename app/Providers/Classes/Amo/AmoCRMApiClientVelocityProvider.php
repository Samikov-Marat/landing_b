<?php

namespace App\Providers\Classes\Amo;

use App\Classes\Site\Amo\AmoCRMApiClientVelocity;
use Illuminate\Support\ServiceProvider;

class AmoCRMApiClientVelocityProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AmoCRMApiClientVelocity::class, function () {
            return new AmoCRMApiClientVelocity();
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
