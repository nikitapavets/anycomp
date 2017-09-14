<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    const HTTP_RESPONSE_SUCCESS = 200;
    const HTTP_RESPONSE_BAD_REQUEST = 400;
    const HTTP_RESPONSE_UNAUTHORIZED = 401;
    const HTTP_RESPONSE_FORBIDDEN = 403;
    const HTTP_RESPONSE_NOT_FOUND = 404;
    const HTTP_RESPONSE_SERVER_ERROR = 500;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $meta = null, $code = ResponseServiceProvider::HTTP_RESPONSE_SUCCESS) {
            if ($meta) {
                $data['meta'] = $meta;
            }

            return Response::json($data, $code);
        });

        Response::macro('error', function($error, $code = ResponseServiceProvider::HTTP_RESPONSE_NOT_FOUND) {
            return Response::json($error, $code);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // ...
    }
}