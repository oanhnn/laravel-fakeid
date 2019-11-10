<?php

namespace Laravel\FakeId;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Arr;
use Illuminate\Support\Manager as IlluminateManager;
use InvalidArgumentException;
use Laravel\FakeId\Contracts\Driver;
use Laravel\FakeId\Contracts\Manager as ManagerContract;
use Laravel\FakeId\Drivers\Base64Driver;
use Laravel\FakeId\Drivers\HashidsDriver;
use Laravel\FakeId\Drivers\HexDriver;
use Laravel\FakeId\Drivers\OptimusDriver;
use Laravel\FakeId\Drivers\PrefixDriver;

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
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * The configuration repository instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->config = $container->make('config');
        // Support Laravel 5
        $this->app = $container;
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config->get('fakeid.default', 'base64');
    }

    /**
     * Create a new driver instance.
     *
     * @param  string $name
     * @return \Laravel\FakeId\Contracts\Driver
     * @throws \InvalidArgumentException
     */
    protected function createDriver($name)
    {
        // First, we will determine if a custom driver creator exists for the given driver and
        // if it does not we will check for a creator method for the driver. Custom creator
        // callbacks allow developers to build their own "drivers" easily using Closures.
        if (isset($this->customCreators[$name])) {
            return $this->callCustomCreator($name);
        }

        $config = (array) $this->config->get("fakeid.drivers.{$name}", []);
        $driver = (string) Arr::pull($config, 'driver', $name);
        $alias = [
            'base64' => Base64Driver::class,
            'hashids' => HashidsDriver::class,
            'hex' => HexDriver::class,
            'optimus' => OptimusDriver::class,
            'prefix' => PrefixDriver::class,
        ];

        if (isset($alias[$driver])) {
            $driver = $alias[$driver];
        }

        if (class_exists($driver) && is_subclass_of($driver, Driver::class)) {
            return $this->container->make($driver, compact('config'));
        }

        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }
}
