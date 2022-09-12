<?php

namespace App\Classes\Site\Jira;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JiraSender
{
    const JIRA_URL = 'https://corp.cdek.ru/rest/api/2/issue';
    const JIRA_LOGIN = 'marketing_cdek';
    const JIRA_PASSWORD = 'OWZWnffNI7LP';

    public static function send(Request $request)
    {
        $fields = [
            'project' => ['id' => 12300],
            'issuetype' => ['id' => 15807],
            'priority' => ['name' => 'Высокий'],
            'summary' => trim($request->input('summary', 'Не указано')),
            'customfield_15747' => $request->input('name', 'Не указано'),
            'customfield_10043' => $request->input('invoice_number', 'Не указано'),
            'customfield_13724' => $request->input('email', 'Не указано'),
            'description' => 'Телефон: ' . $request->input('phone', 'Не указано') .
                PHP_EOL . PHP_EOL .
                $request->input('question', 'Не указано'),
        ];


        $client = new Client();
        $response = $client->request(
            'POST', self::JIRA_URL,
            [
                'auth' => [self::JIRA_LOGIN, self::JIRA_PASSWORD],
                'headers' => ['Content-Type', 'application/json'],
                'json' => ['fields' => $fields],
            ]
        );

        Log::info($response->getBody());
        return true;
    }
}
