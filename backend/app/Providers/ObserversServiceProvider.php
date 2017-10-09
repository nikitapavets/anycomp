<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Repair;
use App\Observers\ElasticsearchRepairObserver;
use Elasticsearch\ClientBuilder;
use App\Observers\ElasticsearchClientObserver;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Client::observe(ElasticsearchClientObserver::class);
        Repair::observe(ElasticsearchRepairObserver::class);
    }

    public function register()
    {
        $this->app->singleton(ElasticsearchClientObserver::class, function()
        {
            return new ElasticsearchClientObserver(ClientBuilder::create()->build());
        });

        $this->app->singleton(ElasticsearchRepairObserver::class, function()
        {
            return new ElasticsearchRepairObserver(ClientBuilder::create()->build());
        });
    }
}