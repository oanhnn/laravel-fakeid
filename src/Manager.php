<?php

namespace Laravel\FakeId;

use Illuminate\Support\Arr;
use Illuminate\Support\Manager as IlluminateManager;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Laravel\FakeId\Contracts\Manager as ManagerContract;
use Laravel\FakeId\Drivers\Base64Driver;
use Laravel\FakeId\Drivers\HashidsDriver;
use Laravel\FakeId\Drivers\OptimusDriver;

/**
 * Class Manager
 *
 * @package     Laravel\FakeId
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class Manager extends IlluminateManager implements ManagerContract
{
    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app->get('config')->get('fakeid.default', 'base64');
    }

    /**
     * Create a new driver instance.
     *
     * @param  string $driver
     * @return mixed
     * @throws \InvalidArgumentException
     */
    protected function createDriver($driver)
    {
        // First, we will determine if a custom driver creator exists for the given driver and
        // if it does not we will check for a creator method for the driver. Custom creator
        // callbacks allow developers to build their own "drivers" easily using Closures.
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        }

        $config = $this->app->get('config')->get("fakeid.drivers.{$driver}", []);
        if (isset($config['driver'])) {
            $method = 'create' . Str::studly($config['driver']) . 'Driver';

            if (method_exists($this, $method)) {
                return $this->$method($driver, Arr::get($config, 'options', []));
            }
        }

        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }

    /**
     * @param  string $name
     * @param  array $config
     * @return Base64Driver
     */
    protected function createBase64Driver(string $name, array $config = [])
    {
        return new Base64Driver();
    }

    /**
     * @param  string $name
     * @param  array $config
     * @return HashidsDriver
     */
    protected function createHashidsDriver(string $name, array $config = [])
    {
        return new HashidsDriver($config);
    }

    /**
     * @param  string $name
     * @param  array $config
     * @return OptimusDriver
     */
    protected function createOptimusDriver(string $name, array $config = [])
    {
        return new OptimusDriver($config);
    }
}
