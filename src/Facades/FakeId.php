<?php

namespace Laravel\FakeId\Facades;

use Illuminate\Support\Facades\Facade;
use Laravel\FakeId\Contracts\Manager;

/**
 * Class FakeId
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 *
 * @method static \Laravel\FakeId\Contracts\Driver driver(string $name = null)
 * @method static \Laravel\FakeId\Manager extend(string $driver, \Closure $callback)
 * @method static string getDefaultDriver()
 * @method static array getDrivers()
 * @method static mixed encode(mixed $data)
 * @method static mixed decode(mixed $data)
 *
 * @see \Laravel\FakeId\Contracts\Manager
 * @see \Laravel\FakeId\Manager
 */
class FakeId extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Manager::class;
    }
}
