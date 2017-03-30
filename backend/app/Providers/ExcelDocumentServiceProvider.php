<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExcelDocumentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->app->singleton('App\Classes\ExcelDocument', function($app)
	    {
		    return new Connection($app['config']['ExcelDocument']);
	    });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
