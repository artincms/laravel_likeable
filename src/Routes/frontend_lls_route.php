<?php
Route::group(['prefix' => config('laravel_likeable_system.frontend_lls_route_prefix'), 'namespace' => 'ArtinCMS\LLS\Controllers', 'middleware' => config('laravel_likeable_system.frontend_lls_middlewares')], function () {
    Route::post('chnageLike', ['as' => 'LLS.chnageLike', 'uses' => 'LikeController@chnageLike']);
});