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

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook'=> [
        'client_id'=>'2081178375459481',
        'client_secret'=>'c787684a7d7e1de76e197306f4dbf7e8',
        'redirect'=>'https://www.shaikhascloset.com/fbcallback',
    ],
    'google'=> [
        'client_id'=>'385144408994-idtef8pqnukek4m1vrjpvisd5t70lvh9.apps.googleusercontent.com',
        'client_secret'=>'osb05mONtWVqo8txC05F1FFA',
        'redirect'=>'https://www.shaikhascloset.com/gmcallback',
    ],

];
