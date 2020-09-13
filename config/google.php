<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Recaptcha
    |--------------------------------------------------------------------------
    |
    | This is all the relevant data that is associated with
    | the Google Recaptcha API.
    | Ref: https://developers.google.com/recaptcha/docs/verify
    | Ref: https://developers.google.com/recaptcha/docs/v3
    |
    */

    // Google Recaptcha Secret Key
    'recaptcha' => [
        'url' => 'https://www.google.com/recaptcha/api/siteverify',
        'secret' => env('GOOGLE_RECAPTCHA_SECRET')
    ],

    // Google 2FA Secret Code
    '2fa' => [
        'secret' => env('GOOGLE_2FA_SECRET'),
    ]

];
