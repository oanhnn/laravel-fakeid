<?php

namespace Laravel\FakeId\Drivers;

use Laravel\FakeId\Contracts\Driver;

/**
 * Class HexDriver
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class HexDriver implements Driver
{
    /**
     * Encode the data.
     *
     * @param  mixed $data
     * @return mixed
     */
    public function encode($data)
    {
        return \bin2hex($data);
    }

    /**
     * Decode the data.
     *
     * @param  mixed $data
     * @return mixed
     */
    public function decode($data)
    {
        return \hex2bin($data);
    }
}
