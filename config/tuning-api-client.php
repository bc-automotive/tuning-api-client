<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tuning Api Token
    |--------------------------------------------------------------------------
    |
    |
    */

    'api_token' => env('TUNING_API_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Tuning Api Token
    |--------------------------------------------------------------------------
    |
    |
    */

    'api_url' => env('TUNING_API_URL', 'https://tuning-api.br-performance.com'),

    /*
    |--------------------------------------------------------------------------
    | Picture format
    |--------------------------------------------------------------------------
    |
    | The format in which the pictures are returned ("binary" or "base64").
    |
    */

    'picture_format' => 'base64',

];