<?php

namespace Laravel\FakeId\Facades;

use Illuminate\Support\Facades\Facade;
use Laravel\FakeId\Manager;

/**
 * Class FakeId
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 *
 * @method static \Laravel\FakeId\Drivers\DriverInterface driver(string $name = null)
 * @method static \Laravel\FakeId\Manager extend(string $driver, \Closure $callback)
 * @method static string getDefaultDriver()
 * @method static array getDrivers()
 * @method static mixed encode(mixed $data)
 * @method static mixed decode(mixed $data)
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
