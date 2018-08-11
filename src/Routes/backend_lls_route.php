<?php
Route::group(['prefix' => config('laravel_comments_system.backend_lcs_route_prefix'), 'namespace' => 'ArtinCMS\LCS\Controllers', 'middleware' => config('laravel_comments_system.backend_lcs_middlewares')], function () {

});