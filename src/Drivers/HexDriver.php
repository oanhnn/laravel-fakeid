<?php

namespace Laravel\FakeId\Drivers;

use Laravel\FakeId\Contracts\FakeDriver;

class HexDriver implements FakeDriver
{
    /**
     * Encode the data.
     *
     * @param  mixed $data
     * @return mixed
     */
    public function encode($data)
    {
        return bin2hex($data);
    }

    /**
     * Decode the data.
     *
     * @param  mixed $data
     * @return mixed
     */
    public function decode($data)
    {
        return hex2bin($data);
    }
}
