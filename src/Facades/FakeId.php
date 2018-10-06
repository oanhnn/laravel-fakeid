<?php

namespace Laravel\FakeId\Facades;

use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\Types\Static_;

/**
 * Class FakeId
 *
 * @method static \Laravel\FakeId\Contracts\FakeDriver connection(string $name = null)
 * @method static \Laravel\FakeId\FakeIdManager setDefaultConnection(string $name)
 * @method static string getDefaultConnection()
 * @method static array|string[] getConnections()
 * @method static \Laravel\FakeId\FakeIdManager extend(string $driver, \Closure $callback)
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
        return 'fakeid';
    }
}
