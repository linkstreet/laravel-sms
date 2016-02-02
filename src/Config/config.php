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
    */

    'adapter' => [
        /*
         * KAP SYSTEMS
         */
        'kap' => [
            'username' => '',
            'password' => '',
            'sender' => ''
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | International country code with Adapters
    |--------------------------------------------------------------------------
    |
    | This a list of international country codes with available SMS gateway
    | providers with priority (Left to Right).
    |
    */

    'code' => [
        91 => []
    ]
];
