<?php

return [

    /* Important Settings */
    'backend_lls_middlewares'   => explode(',', env('BACKEND_LLS_MIDDLEWARES', 'web')),
    'frontend_lls_middlewares'  => explode(',', env('FRONTEND_LLS_MIDDLEWARES', 'web', 'throttle:60,1')),
    // you can change default route from sms-admin to anything you want
    'backend_lls_route_prefix'  => env('BACKEND_LLS_ROUTE_PERFIX', 'LLS'),
    'frontend_lls_route_prefix' => env('FRONTEND_LLS_ROUTE_PERFIX', 'LLS'),
    // ======================================================================
    'user_model'                => env('LLS_USER_MODEL', 'App\User'),
//    'Trait' => [
//        'Path' => 'App\Traits\LaraveLikeablesSystem',
//        'Name' => 'LaraveLikeablesSystem',
//        'Method' => 'setDataTableColumn',
//    ]
];