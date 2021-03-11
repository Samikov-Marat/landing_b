<?php


namespace App\Classes;


use App\Dummy;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DatabaseSynchronizer
{

    public static function give($table)
    {
        $model = new Dummy();
        $model->setTable($table);
        return $model->newQuery()->get();
    }

    public static function take()
    {
        $tables = [
            'languages',
            'offices',
            'pages',
            'permissions',
            'role_permission',
            'roles',
            'site_page',
            'sites',
            'tariffs',
            'text_types',
            'texts',
            'user_role',
            'users'
        ];

        $url = 'http://landing.dev.cdek.ru/request/give-table';

        $client = new Client();
        foreach ($tables as $table) {
            $from = $url . '?' . http_build_query(['table' => 'users']);
            $client->get($from);
        }
    }


}
