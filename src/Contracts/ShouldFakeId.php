<?php

namespace Laravel\FakeId\Contracts;

/**
 * Interface ShouldFakeId
 *
 * @package     Laravel\FakeId\Contracts
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
interface ShouldFakeId
{
    /**
     * @return \Laravel\FakeId\Contracts\Driver
     */
    public function getFakeIdDriver(): Driver;
}
