<?php

namespace App\Classes\Site\Jira;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

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
            'summary' => trim($request->input('summary', 'Не указано')),
            'customfield_10043' => $request->input('invoice_number', 'Не указано'),
            'customfield_13724' => $request->input('email', 'Не указано'),
            'description' => 'Телефон: ' . $request->input('phone', 'Не указано') .
                PHP_EOL . PHP_EOL .
                $request->input('question', 'Не указано'),
        ];

        $client = new Client();
        $client->request(
            'POST', self::JIRA_URL,
            [
                'auth' => [self::JIRA_LOGIN, self::JIRA_PASSWORD],
                'headers' => ['Content-Type', 'application/json'],
                'json' => ['fields' => $fields],
            ]
        );
        return true;
//        if ($this->curl->curl_error) {
//            throw new \Exception($this->curl->curl_error_message . PHP_EOL . $this->curl->response);
//        }
//        if ($this->curl->http_error) {
//            throw new \Exception($this->curl->http_error_message . PHP_EOL . $this->curl->response);
//        }
//        $result = $this->curl->response;
//        if ($form instanceof JiraFormHasFile) {
//            $issueId = $this->parseResponse($this->curl->response)->id;
//            $this->attachFiles($issueId, $form->getFiles());
//        }
//        return $result;
    }
}
