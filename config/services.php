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
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URL'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URL'),
    ], 'twitter' => [
        'client_id' => 'W9ba87LefPkhad1siNapDGaHD',
        'client_secret' => 'T9xY6QiHOGPzHNds3srRQuGAgyrY5rDoT0NXF6ZBzAYtSxcmaC',
        'redirect' => 'https://developers.google.com/oauthplayground',
    ],
    "apple" => [
        "client_id" => env("APPLE_CLIENT_ID"),
        "client_secret" => env("APPLE_CLIENT_SECRET"),
        'redirect' => env('APPLE_REDIRECT_URL'),

    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
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
    ]
];



//FACEBOOK_CLIENT_ID=1876323382672084
//FACEBOOK_CLIENT_SECRET=c754120d6f49fdb057c044ae1ee94ddc
//FACEBOOK_REDIRECT_URL=http://cosette.araac.info/auth/facebook/callback

