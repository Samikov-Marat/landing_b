<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

use Illuminate\Contracts\Events\Dispatcher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Blade::directive(
            'd',
            function ($expression) {
                return "<?php echo preg_replace('#(\d)(\s)(\d)#u', '\$1&nbsp;\$3', nl2br(e(\$dictionary[$expression]))); ?>";
            }
        );

        Blade::directive(
            'knumber',
            function ($expression) {
                return "<?php echo number_format((int)\$keyNumbers[$expression], 0, ',', '&nbsp;')  ?>";
            }
        );

        URL::forceScheme('https');
    }
}
