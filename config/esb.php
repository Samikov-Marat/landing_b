<?php

return [
    // Настройки подключения к RabbitMq
    'rabbit' => [
        'host' => env('RABBIT_HOST', 'localhost'),
        'port' => (int)env('RABBIT_PORT', 5672),
        'user' => env('RABBIT_USER', 'guest'),
        'password' => env('RABBIT_PASSWORD', 'guest'),
        'vhost' => env('RABBIT_VHOST', '/'),
        'count' => (int)env('RABBIT_COUNT', 5),
    ],

    // все активные обработчики очередей
    'handlers' => [
//        OrderQueueHandler::class,
    \App\Classes\OfficeQueueHandler::class,
    ],

    // настройки для отдельной очереди
    'queue' => [
//        CityQueueHandler::queueName() => [
//            'dlq_enabled' => true,
//        ],
//        'obj.order' => [
//            'dlq_enabled' => false,
//        ]
    ],
];
