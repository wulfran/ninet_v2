<?php

return [
    'name' => env('CONFIG_NAME'),
    'tax_number' => env('CONFIG_TAX_NUMBER'),
    'address' => [
        'street' => env('CONFIG_STREET'),
        'street_number' => env('config_street_number'),
        'post_code' => env('CONFIG_POST_CODE'),
        'city' => env('CONFIG_CITY'),
        'country_id' => env('CONFIG_COUNTRY_ID')
    ],
];
