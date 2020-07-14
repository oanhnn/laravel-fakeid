<?php

namespace Tests\Unit;

use InvalidArgumentException;
use Laravel\FakeId\Drivers\ChainDriver;
use Laravel\FakeId\Drivers\HexDriver;
use Laravel\FakeId\Drivers\PrefixDriver;
use PHPUnit\Framework\TestCase;

/**
 * Class ChainDriverTest
 *
 * @package     Tests\Unit
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class ChainDriverTest extends TestCase
{
    /**
     * Test it should return same value with input after encode and decode
     *
     * @return void
     */
    public function testItShouldReturnSameValueAfterEncodeAndDecode()
    {
        $driver = new ChainDriver([
            new HexDriver(),
            new PrefixDriver(['prefix' => 'ABC']),
        ]);

        $input = '123456';
        $encoded = $driver->encode($input);
        $decoded = $driver->decode($encoded);

        $this->assertNotSame($input, $encoded);
        $this->assertSame($input, $decoded);
    }

    /**
     * Test it should throw exception when it was created with invalid config options
     *
     * @return void
     */
    public function testItShouldThrowExceptionWhenInvalidConfigOptions()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('List drivers MUST not empty.');

        new ChainDriver([]);
    }
}
