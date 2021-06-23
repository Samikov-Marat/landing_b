<?php

namespace App\Listeners;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuBuilder
{
    var $routeRoots = [];
    var $root = '';
    var $menu = [];

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = [
            ['route' => 'admin.sites.index', 'text' => 'Сайты', 'icon' => 'far fa-folder',],
            ['route' => 'admin.pages.index', 'text' => 'Страницы', 'icon' => 'far fa-file',],
            ['route' => 'admin.top_offices.index', 'text' => 'Избранные офисы', 'icon' => 'fab fa-fort-awesome',],
            ['route' => 'admin.permissions.index', 'text' => 'Разрешения', 'icon' => 'fas fa-map-signs',],
            ['route' => 'admin.roles.index', 'text' => 'Роли', 'icon' => 'far fa-address-card',],
            ['route' => 'admin.users.index', 'text' => 'Пользователи', 'icon' => 'fas fa-user',],
        ];
        $this->routeRoots = [
            'admin.languages.index' => 'admin.sites.index',
            'admin.texts.index' => 'admin.sites.index',
        ];

        $this->prepareMenu();
    }

    /**
     * Handle the event.
     *
     * @param BuildingMenu $event
     * @return
     */
    public function handle(BuildingMenu $event)
    {
        $event->menu->add('Администрирование');
        foreach ($this->menu as $item) {
            if (Gate::allows($item['route'])) {
                $event->menu->add($item);
            }
        }
    }

    private function prepareMenu()
    {
        $this->root = Route::current()->getName();
        if (isset($this->routeRoots[$this->root])) {
            $this->root = $this->routeRoots[$this->root];
        }
        foreach ($this->menu as &$item) {
            $item['active'] = $this->isActive($item['route']);
        }
    }

    private function isActive(string $route)
    {
        return $route == $this->root;
    }

}
