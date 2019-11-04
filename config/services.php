<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    'wechat_web' => [
        'client_id' => env('WECHAT_WEB_APP_ID'),
        'client_secret' => env('WECHAT_WEB_APP_SECRET'),
        'redirect' => env('WECHAT_WEB_CALLBACK_URL'),
        'scopes' => preg_split('/,/', env('WECHAT_WEB_SCOPES'), null, PREG_SPLIT_NO_EMPTY), // can not use explode, see vlucas/phpdotenv#175
        'union_id_with' => preg_split('/,/', env('WECHAT_WEB_UNION_ID_WITH'), null, PREG_SPLIT_NO_EMPTY),
    ],

];
