<?php

return [

    /* Important Settings */
    'backend_lls_middlewares' => ['web'],
    'frontend_lls_middlewares' => ['web'],
    // you can change default route from sms-admin to anything you want
    'backend_lls_route_prefix' => 'LLS',
    'frontend_lls_route_prefix' => 'LLS',
    // SMS.ir Api Key
    'api-key' => env('SMSIR-API-KEY','Your api key'),
    // ======================================================================
    //allow user to upload private file in filemanager
    'autoPublish'=>true,
    'guestCanComments'=>true,
    'loginUrl'=>'http://127.0.0.1:8000/login',
    'registerUrl'=>'http://127.0.0.1:8000/register',
    'userModel'=>'App\User',
    'Trait' => [
        'Path' => 'App\Traits\LaraveLikeablesSystem',
        'Name' => 'LaraveLikeablesSystem',
        'Method' => 'setDataTableColumn',
    ]



];