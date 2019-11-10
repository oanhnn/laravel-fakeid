<?php

namespace Tests\Unit;

use Laravel\FakeId\Drivers\PrefixDriver;
use PHPUnit\Framework\TestCase;

/**
 * Class PrefixDriverTest
 *
 * @package     Tests\Unit
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class PrefixDriverTest extends TestCase
{
    /**
     * Test it should return same value with input after encode and decode
     *
     * @return void
     */
    public function testItShouldReturnSameValueAfterEncodeAndDecode()
    {
        $driver = new PrefixDriver([
            'prefix' => 'fake',
        ]);
        $input = '123456';
        $encoded = $driver->encode($input);
        $decoded = $driver->decode($encoded);

        $this->assertNotSame($input, $encoded);
        $this->assertSame($input, $decoded);
    }
}
