<?php

namespace Laravel\FakeId;

use Exception;
use Laravel\FakeId\Contracts\ShouldFakeId;

trait RoutesWithFakeId
{
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
