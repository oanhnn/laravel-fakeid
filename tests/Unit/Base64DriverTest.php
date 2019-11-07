<?php

namespace Tests\Unit;

use Laravel\FakeId\Drivers\Base64Driver;
use PHPUnit\Framework\TestCase;

/**
 * Class Base64DriverTest
 *
 * @package     Tests\Unit
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class Base64DriverTest extends TestCase
{
    /**
     * Test it should return same value with input after encode and decode
     *
     * @return void
     */
    public function testItShouldReturnSameValueAfterEncodeAndDecode()
    {
        $driver = new Base64Driver();
        $input = '123456';
        $encoded = $driver->encode($input);
        $decoded = $driver->decode($encoded);

        $this->assertNotSame($input, $encoded);
        $this->assertSame($input, $decoded);
    }
}
