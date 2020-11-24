<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;


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
        Builder::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('Администрирование');
            $menu = [
                ['route' => 'admin.sites.index', 'text' => 'Сайты', 'icon' => 'far fa-folder',],
                ['route' => 'admin.pages.index', 'text' => 'Страницы', 'icon' => 'far fa-file',],
                ['route' => 'admin.permissions.index', 'text' => 'Разрешения', 'icon' => 'fas fa-map-signs',],
                ['route' => 'admin.roles.index', 'text' => 'Роли', 'icon' => 'far fa-address-card',],
                ['route' => 'admin.users.index', 'text' => 'Пользователи', 'icon' => 'fas fa-user',],
            ];
            foreach ($menu as $item){
                if(Gate::allows($item['route'])){
                    $event->menu->add($item);
                }
            }
        });

        Blade::directive('d', function ($expression) {
            return "<?php echo nl2br(e(\$dictionary[$expression])); ?>";
        });
    }
}
