<?php

namespace Laravel\FakeId\Contracts;

interface FakeDriver
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
