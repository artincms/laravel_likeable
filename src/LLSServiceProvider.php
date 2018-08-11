<?php

namespace ArtinCMS\LLS;

use Illuminate\Support\ServiceProvider;

class LLSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
    	// the main router
        $this->loadRoutesFrom( __DIR__.'/Routes/backend_lls_route.php');
        $this->loadRoutesFrom( __DIR__.'/Routes/frontend_lls_route.php');
	    // the main views folder
	    $this->loadViewsFrom(__DIR__ . '/Views', 'laravel_likeable_system');
	    // the main migration folder for create sms_ir tables

	    // for publish the views into main app
	    $this->publishes([
		    __DIR__ . '/Views' => resource_path('views/vendor/laravel_likeable_system'),
	    ]);

	    $this->publishes([
		    __DIR__ . '/Database/Migrations/' => database_path('migrations')
	    ], 'migrations');

	    // for publish the assets files into main app
	    $this->publishes([
		    __DIR__.'/assets' => public_path('vendor/laravel_likeable_system'),
	    ], 'public');

	    // for publish the sms_ir config file to the main app config folder
	    $this->publishes([
		    __DIR__ . '/Config/LLS.php' => config_path('laravel_likeable_system.php'),
	    ]);
        $this->publishes([
            __DIR__ . '/Traits/LaraveLikeablesSystem.php' => app_path('Traits/LaravelCommentSystem.php'),
        ]);
        $this->publishes([
            __DIR__ . '/Components' => resource_path('assets/js/components/laravel_likeable_system'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	// set the main config file
	    $this->mergeConfigFrom(
		    __DIR__ . '/Config/LLS.php', 'laravel_likeable_system'
	    );

		// bind the LLS Facade
	    $this->app->bind('LLS', function () {
		    return new LLS;
	    });
    }
}
