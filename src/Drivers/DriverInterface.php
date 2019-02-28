<?php

namespace Laravel\FakeId\Drivers;

/**
 * Interface DriverInterface
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
interface DriverInterface
{
    /**
     * Encode the data.
     *
     * @param  mixed $data
     * @return mixed
     */
    public function encode($data);

    /**
     * Decode the data.
     *
     * @param  mixed $data
     * @return mixed
     */
    public function decode($data);
}
