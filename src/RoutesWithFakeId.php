<?php

namespace Laravel\FakeId;

use Exception;
use Laravel\FakeId\Contracts\ShouldFakeId;
use Laravel\FakeId\Drivers\DriverInterface;
use Laravel\FakeId\Facades\FakeId;

/**
 * Trait RoutesWithFakeId
 *
 * @package     Laravel\FakeId
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
trait RoutesWithFakeId
{
    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    abstract public function getAttribute($key);

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    abstract public function getRouteKeyName();

    /**
     * @return \Laravel\FakeId\Drivers\DriverInterface
     */
    public function getFakeIdDriver(): DriverInterface
    {
        return FakeId::driver();
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        $key = $this->getAttribute($this->getRouteKeyName());

        if ($this instanceof ShouldFakeId) {
            $key = $this->getFakeIdDriver()->encode($key);
        }

        return $key;
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        if ($this instanceof ShouldFakeId) {
            try {
                $value = $this->getFakeIdDriver()->decode($value);
            } catch (Exception $e) {
                return null;
            }
        }

        return $this->where($this->getRouteKeyName(), $value)->first();
    }
}
