<?php

namespace App\Providers;

use App\Services\StringTransformator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'phone',
            function ($attribute, $value, $parameters, $validator) {
                $st = new StringTransformator();

                return (bool)preg_match(
                    '/^375(29|33|25|44)[0-9]{7}$/',
                    $st->clearPhone($value)
                );
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
