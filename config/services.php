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

    'ameriabank' => [
        'client_id' => env('AMERIABANK_CLIENT_ID'),
        'username' => env('AMERIABANK_USERNAME'),
        'password' => env('AMERIABANK_PASSWORD'),
        'init_url' => env(
            'AMERIABANK_INIT_URL',
            'https://services.ameriabank.am/VPOS/api/VPOS/InitPayment'
        ),
        'details_url' => env(
            'AMERIABANK_DETAILS_URL',
            'https://services.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails'
        ),
        'payment_url' => env(
            'AMERIABANK_PAYMENT_URL',
            'https://services.ameriabank.am/VPOS/Payments/Pay'
        ),
        'callback_url' => env('AMERIABANK_CALLBACK_URL'),
        'currency' => env('AMERIABANK_CURRENCY', '051'),
        'description' => env('AMERIABANK_DESCRIPTION', 'Poolzone.am Product(s)'),
    ],

    'recaptcha' => [
        'secret' => env('RECAPTCHA_SECRET'),
    ],

];
