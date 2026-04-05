<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    */

    'default' => env('MAIL_MAILER', 'smtp'), // Changé 'log' par 'smtp' pour que ça envoie vraiment

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 1025), // Port Laragon par défaut
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        // ... autres mailers (inchangés)
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'contact@isiburger.sn'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME', 'ISI Burger')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "To" Address (AJOUTÉ POUR TON EXERCICE)
    |--------------------------------------------------------------------------
    | Cette section permet de forcer l'envoi de TOUS les mails vers ton adresse
    | de test, peu importe ce qui est saisi dans l'application.
    */

    'to' => [
        'address' => env('MAIL_ALWAYS_TO'),
        'name' => 'Test Famata',
    ],

];
