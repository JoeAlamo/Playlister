<?php

namespace Playlister\Providers;

use Illuminate\Support\ServiceProvider;
use Playlister\Services\YoutubeAPI\YoutubeAPIService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Playlister\Services\YoutubeAPI\YoutubeAPI', function ($app) {
            return new YoutubeAPIService($app['auth.driver'], $app['request'], $app['config']);
        });
    }
}
