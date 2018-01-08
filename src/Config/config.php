<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SMS service gateway providers
    |--------------------------------------------------------------------------
    |
    | Each SMS gateway providers auth & other details are stored in this array
    | to use by their adapters.
    |
    | Supported adapter: twilio, kap
    |
    */

    'default' => 'kap',

    'connections' => [

        'twilio' => [
            'adapter' => 'twilio',
            'sid' => env('TWILIO_SID'),
            'token' => env('TWILIO_TOKEN'),
            'from' => env('TWILIO_FROM'),
            'throttle' => env('TWILIO_THROTTLE', 1),
        ],

        'kap' => [
            'adapter' => 'kap',
            'username' => env('KAP_USERNAME'),
            'password' => env('KAP_PASSWORD'),
            'sender' => env('KAP_SENDER'),
        ],

    ],

    'priority' => [
        'IN' => ['kap']
    ],

];
