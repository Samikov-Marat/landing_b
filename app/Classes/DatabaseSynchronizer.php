<?php


namespace App\Classes;

use App\Dummy;
use GuzzleHttp\Client;

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
            $from = $url . '?' . http_build_query(['table' => $table]);
            $response = $client->get($from);
            $content = $response->getBody()->getContents();
            $items = json_decode($content, true);
            foreach ($items as $item) {
                $model = new Dummy();
                $model->setTable($table);
                $model->fill($item);
                $model->save();
            }
        }
    }
}
