<?php

namespace App\Classes\Admin;

use App\Classes\OfficeEsbRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OfficeApi
{
    public function load(string $uuid)
    {
        $response = Http::post(config('structure_of_company.office_get'), [
            'uuid' => $uuid,
            'enableTrace' => false,
            'lang' => 'rus',
            'token' => '',
        ]);
        if ($response->serverError()) {
            Log::error('Ошибка запроса /api/v3/office/esb/get');
            return;
        }
        if ($response->body() == '') {
            Log::error('Пустой ответ (uuid не найден)');
            return;
        }
        app(OfficeEsbRepository::class, ['fromEsb' => false])
            ->save($response->json());
    }
}
