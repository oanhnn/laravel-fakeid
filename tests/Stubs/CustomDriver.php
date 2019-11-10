<?php

namespace Tests\Stubs;

use Laravel\FakeId\Contracts\Driver;
use Laravel\FakeId\Drivers\PrefixDriver;

/**
 * Class CustomDriver
 *
 * Stub class for test with custom driver
 *
 * @package     Tests\Stubs
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class CustomDriver extends PrefixDriver implements Driver
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(['prefix' => 'custom']);
    }
}
