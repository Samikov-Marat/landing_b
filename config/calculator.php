<?php
return [
    'city_url' =>
        env('APP_ENV', 'local') == 'production'
            ? 'http://production.locality.service.cdek.tech:8909/api/locality/international/autocomplete/city'
            : 'http://qa2.locality.service.cdek.tech:8909/api/locality/international/autocomplete/city',
    'url' =>
        env('APP_ENV', 'local') == 'production'
            ? 'http://172.16.184.153:8024/api/calculator/getServices'
            : 'http://qa2.calculator.service.cdek.tech:8024/api/calculator/getServices',
    // Универсальный договор без привилегий
    'sender_contract_id' => '533ac9a1-5743-4805-b635-95d0ff324c1e',
    // Бангладеш для b2b
    'bangladesh_contract_id' => '977d7aaf-ec3e-467d-a6e3-abeb10fd44cd',
];
