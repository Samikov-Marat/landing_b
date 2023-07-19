<?php
return [
    'city_url' => env('CITY_AUTOCOMPLETE', 'http://production.locality.service.cdek.tech:8909/api/locality/international/autocomplete/city'),
    'url' => env('CALCULATOR_URL', 'http://172.16.184.153:8024/api/calculator/getServices'),
    // Универсальный договор без привилегий
    'sender_contract_id' => env('CALCULATOR_UNIVERSAL_CONTRACT_ID', ''),
    'special_sender_contracts' => [
        'cdek-bd.com' => '977d7aaf-ec3e-467d-a6e3-abeb10fd44cd'
    ]
];
