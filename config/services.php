<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
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
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'facebook' => [
        'client_id' => '301584211561657',
        'client_secret' => 'f609a9c74001559d3f3e4c443fc38808',
        'redirect' => 'https://behe.gcosoftware.vn/auth/facebook/callback',
    ],

    'google' => [

        'client_id' => '288928438887-kfrs2u1kfr0t66lk36kvslrgoj2cdl9i.apps.googleusercontent.com',

        'client_secret' => 'ynbygboLi5YsAldsi9E8bHQK',

        'redirect' => 'https://behe.gcosoftware.vn/auth/google/callback',

    ],

];
