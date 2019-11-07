<?php

namespace Laravel\FakeId;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Laravel\FakeId\Contracts\Manager as ManagerContract;

/**
 * Class ServiceProvider
 *
 * @package     Laravel\FakeId
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
        $this->app->singleton(ManagerContract::class, function ($app) {
            return new Manager($app);
        });
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
            ], 'laravel-fakeid-config');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            ManagerContract::class,
        ];
    }
}
