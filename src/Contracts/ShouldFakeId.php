<?php

namespace Laravel\FakeId\Contracts;

use Laravel\FakeId\Drivers\DriverInterface;

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
     * @return \Laravel\FakeId\Drivers\DriverInterface
     */
    public function getFakeIdDriver(): DriverInterface;
}
