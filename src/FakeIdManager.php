<?php

namespace Laravel\FakeId;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Laravel\FakeId\Drivers\Base64Driver;
use Laravel\FakeId\Drivers\HashidsDriver;
use Laravel\FakeId\Drivers\OptimusDriver;

class FakeIdManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The registered custom driver creators.
     *
     * @var array
     */
    protected $customCreators = [];

    /**
     * The array of created "connections".
     *
     * @var array
     */
    protected $connections = [];

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->connection()->$method(...$parameters);
    }

    /**
     * Get a fake ID connection instance.
     *
     * @param  string|null $name
     * @return \Laravel\FakeId\Contracts\FakeDriver
     */
    public function connection($name = null)
    {
        $name = $name ?: $this->getDefaultConnection();
        if (!isset($this->connections[$name])) {
            $config = Config::get("fakeid.connections.{$name}", []);
            $driver = (string)Arr::pull($config, 'driver', $this->getDefaultDriver());

            $this->connections[$name] = $this->createConnection($driver, $config);
        }

        return $this->connections[$name];
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultConnection()
    {
        return $this->app['config']['fakeid.default'];
    }

    /**
     * Set the default connection name.
     *
     * @param  string $name
     * @return $this
     */
    public function setDefaultConnection($name)
    {
        $this->app['config']['fakeid.default'] = $name;

        return $this;
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    protected function getDefaultDriver()
    {
        return 'base64';
    }

    /**
     * Create a new driver instance for the given driver.
     *
     * We will check to see if a creator method exists for the given driver,
     * and will call the Closure if so, which allows us to have a more generic
     * resolver for the drivers themselves which applies to all connections.
     *
     * @param  string $driver
     * @param  array $config
     * @return mixed
     * @throws \InvalidArgumentException
     */
    protected function createConnection($driver, array $config = [])
    {
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver, $config);
        }

        $method = 'create' . Str::studly($driver) . 'Driver';
        if (method_exists($this, $method)) {
            return $this->$method($config);
        }

        throw new InvalidArgumentException("Unsupported driver [$driver]");
    }

    /**
     * @return Base64Driver
     */
    protected function createBase64Driver()
    {
        return new Base64Driver();
    }

    /**
     * @param array $config
     * @return HashidsDriver
     */
    protected function createHashidsDriver(array $config = [])
    {
        return new HashidsDriver($config);
    }

    /**
     * @param array $config
     * @return OptimusDriver
     */
    protected function createOptimusDriver(array $config = [])
    {
        return new OptimusDriver($config);
    }

    /**
     * Call a custom driver creator.
     *
     * @param  string $driver
     * @param  array $config
     * @return mixed
     */
    protected function callCustomCreator($driver, array $config = [])
    {
        return $this->customCreators[$driver]($this->app, $config);
    }

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string $driver
     * @param  \Closure $callback
     * @return $this
     */
    public function extend($driver, Closure $callback)
    {
        $this->customCreators[$driver] = $callback;

        return $this;
    }

    /**
     * @return array
     */
    public function getConnections()
    {
        return array_keys($this->connections);
    }
}
