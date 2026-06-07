<?php

return [
    'default' => env('AUTHENKA_DEFAULT_DRIVER'),
    'drivers' => [
        // todo: add driver config
    ],
    'cache' => [
        'enabled' => env('AUTHENKA_CACHE_ENABLED', false),
        'store' => env('AUTHENKA_CACHE_DRIVER', 'redis'),
        'ttl' => env('AUTHENKA_CACHE_TTL', 60),
        'prefix' => env('AUTHENKA_CACHE_PREFIX', 'authenka'),
    ]
];