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

    'facebook' => [
        'client_id' => env('FB_CLIENT_ID'),         // Your Facebook Client ID
        'client_secret' => env('FB_CLIENT_SECRET'), // Your Facebook Client Secret
        'redirect' => env('FB_REDIRECT'),
    ],

    'linkedin' => [
        'linkedin_client_id' => env('LINKEDIN_CLIENT_ID'),         // Your linkedin Client ID
        'linkedin_client_secret' => env('LINKEDIN_CLIENT_SECRET'), // Your linkedin Client Secret
        'linkedin_redirect' => env('LINKEDIN_REDIRECT'),
        'linkedin_scope' => env('LINKEDIN_SCOPES'),
    ],

];
