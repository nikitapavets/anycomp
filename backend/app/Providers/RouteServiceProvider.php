<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $namespaceApi = 'App\Http\Controllers\Api';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapApiRoutes($router);
        $this->mapAdminRoutes($router);
        $this->mapWebRoutes($router);
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group(
            [
                'namespace' => $this->namespace,
                'middleware' => 'web',
            ],
            function ($router) {
                require app_path('Http/routes/web.php');
            }
        );
    }

    protected function mapApiRoutes(Router $router)
    {
        $router->group(
            [
                'namespace' => $this->namespaceApi,
                'middleware' => 'api',
                'prefix' => 'api'
            ],
            function ($router) {
                require app_path('Http/routes/api.php');
            }
        );
    }

    protected function mapAdminRoutes(Router $router)
    {
        $router->group(
            [
                'namespace' => $this->namespace,
                'middleware' => 'admin',
                'prefix' => 'admin'
            ],
            function ($router) {
                require app_path('Http/routes/admin.php');
            }
        );
    }
}
