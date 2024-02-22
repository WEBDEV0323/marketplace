<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
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

    'stripe' => [
        'key'    => 'pk_live_51MMzn4A203jpD2JXbjcrKJcLlqi2qFYIU014N3E63afF0InBbpcufwkKdAN53cK6QQePe1r8BUhpud6ksKGViP1n0092fwOZ3Y',
        'secret' => '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',
    ],
];
