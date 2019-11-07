<?php

namespace Tests\Integration;

use Laravel\FakeId\Facades\FakeId;
use Laravel\FakeId\Contracts\Manager;
use Tests\TestCase;

/**
 * Class FacadeTest
 *
 * @package     Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class FacadeTest extends TestCase
{
    /**
     * Test facade should resolves root object
     *
     * @return void
     */
    public function testItShouldResolvesRootObject()
    {
        $obj = FakeId::getFacadeRoot();

        $this->assertInstanceOf(Manager::class, $obj);
    }

    /**
     * Test facade can call encode and decode
     *
     * @return void
     */
    public function testItCanEncodeAndDecode()
    {
        $input = '123456';
        $encoded = FakeId::encode($input);
        $decoded = FakeId::decode($encoded);

        $this->assertSame($input, $decoded);
    }
}
