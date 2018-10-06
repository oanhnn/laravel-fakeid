<?php

namespace Laravel\FakeId;

use Illuminate\Support\ServiceProvider;

class FakeIdServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // register config
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/fakeid.php', 'fakeid');

        // register service
        $this->app->singleton('fakeid', function ($app) {
            return new FakeIdManager($app);
        });
        $this->app->alias('fakeid', FakeIdManager::class);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // publish vendor resources
        if ($this->app->runningInConsole()) {
            $this->publishes([
                dirname(__DIR__) . '/config/fakeid.php' => config_path('fakeid.php')
            ], 'config');
        }
    }
}
