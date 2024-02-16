<?php

namespace App\Providers\Classes;

use App\Classes\Admin\OfficeEsbMass;
use Illuminate\Support\ServiceProvider;

class OfficeEsbMassProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public $bindings = [
        OfficeEsbMass::class => OfficeEsbMass::class,
    ];
    public function register()
    {
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
