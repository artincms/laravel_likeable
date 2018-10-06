<?php

return [

    /* Important Settings */
    'backend_lls_middlewares' => ['web'],
    'frontend_lls_middlewares' => ['web','throttle:60,1'],
    // you can change default route from sms-admin to anything you want
    'backend_lls_route_prefix' => 'LLS',
    'frontend_lls_route_prefix' => 'LLS',
    // SMS.ir Api Key
    'api-key' => env('SMSIR-API-KEY','Your api key'),
    // ======================================================================
    'user_model'=>'App\User',
    'Trait' => [
        'Path' => 'App\Traits\LaraveLikeablesSystem',
        'Name' => 'LaraveLikeablesSystem',
        'Method' => 'setDataTableColumn',
    ]
];