<?php

namespace App\Listeners;

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
            ['route' => 'admin.aliases.index', 'text' => 'Псевдонимы', 'icon' => 'fa fa-compass',],
            ['route' => 'admin.sites.index', 'text' => 'Сайты', 'icon' => 'far fa-folder',],
            ['route' => 'admin.pages.index', 'text' => 'Страницы', 'icon' => 'far fa-file',],
            ['route' => 'admin.top_offices.index', 'text' => 'Международные офисы', 'icon' => 'fab fa-fort-awesome',],
            ['route' => 'admin.world_languages.index', 'text' => 'Международные языки', 'icon' => 'fas fa-om',],
            ['route' => 'admin.franchisees.index', 'text' => 'Франчайзи', 'icon' => 'fa fa-rocket',],
            ['route' => 'admin.tariffs.index', 'text' => 'Тарифы', 'icon' => 'far fa-credit-card',],
            ['route' => 'admin.tariff_translation.index', 'text' => 'Переводы тарифов', 'icon' => 'fas fa-language',],
            ['route' => 'admin.tariff_types.index', 'text' => 'Типы тарифов', 'icon' => 'fas fa-arrow-circle-right',],
            [
                'route' => 'admin.tariff_types_translation.index',
                'text' => 'Переводы типов тарифов',
                'icon' => 'fas fa-book-open',
            ],
            ['route' => 'admin.yandex_metrica_goals.index', 'text' => 'Яндекс цели', 'icon' => 'fas fa-bullseye',],
            ['route' => 'admin.amo.index', 'text' => 'AMOcrm', 'icon' => 'fa fa-font',],
            ['route' => 'admin.statistics.index', 'text' => 'Статистика UTM', 'icon' => 'fas fa-book-open',],
            ['route' => 'admin.permissions.index', 'text' => 'Разрешения', 'icon' => 'fas fa-map-signs',],
            ['route' => 'admin.roles.index', 'text' => 'Роли', 'icon' => 'far fa-address-card',],
            ['route' => 'admin.users.index', 'text' => 'Пользователи', 'icon' => 'fas fa-user',],
            ['route' => 'admin.countries.index', 'text' => 'Страны', 'icon' => 'far fa-folder',],
            ['route' => 'admin.currency.index', 'text' => 'Валюты', 'icon' => 'fas fa-money-bill',],
            ['route' => 'admin.office_esb.index', 'text' => 'Офисы шины', 'icon' => 'fas fa-exchange-alt',],
        ];

        $this->menuFranchisee =[
            ['route' => 'admin.franchisee_admin.texts.index', 'text' => 'Тексты', 'icon' => 'far fa-file',],
            ['route' => 'admin.franchisee_admin.news_articles.index', 'text' => 'Новости', 'icon' => 'fas fa-newspaper',],
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
     * @return void
     */
    public function handle(BuildingMenu $event): void
    {
        $event->menu->add('Администрирование');
        foreach ($this->menu as $item) {
            if (Gate::allows($item['route'])) {
                $event->menu->add($item);
            }
        }
        foreach ($this->menuFranchisee as $item) {
            if (Gate::allows('is_franchisee')) {
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

    private function isActive(string $route): bool
    {
        return $route == $this->root;
    }

}
