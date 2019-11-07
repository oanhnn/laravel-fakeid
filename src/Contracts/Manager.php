<?php

namespace Laravel\FakeId\Contracts;

use Closure;

/**
 * Interface Manager
 *
 * @package     Laravel\FakeId\Contracts
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
interface Manager
{
    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return \Laravel\FakeId\Contracts\Driver
     * @throws \InvalidArgumentException
     */
    public function driver($driver = null);

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string    $driver
     * @param  \Closure  $callback
     * @return self
     */
    public function extend($driver, Closure $callback);

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver();

    /**
     * Get all of the created "drivers".
     *
     * @return array
     */
    public function getDrivers();
}
