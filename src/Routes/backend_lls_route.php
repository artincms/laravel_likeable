<?php
Route::group(['prefix' => config('laravel_likeable_system.backend_lls_route_prefix'), 'namespace' => 'ArtinCMS\LLS\Controllers', 'middleware' => config('laravel_likeable_system.backend_lls_middlewares')], function () {
    Route::get('manageLls', ['as' => 'LLS.manageLls', 'uses' => 'LikeController@manageLls']);
    Route::post('getLikesGrid', ['as' => 'LLS.getLikesGrid', 'uses' => 'LikeController@getLikesGrid']);
});