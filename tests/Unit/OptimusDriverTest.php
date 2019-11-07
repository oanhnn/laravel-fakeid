<?php

namespace Tests\Unit;

use Laravel\FakeId\Drivers\OptimusDriver;
use PHPUnit\Framework\TestCase;

/**
 * Class OptimusDriverTest
 *
 * @package     Tests\Unit
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class OptimusDriverTest extends TestCase
{
    /**
     * Test it should return same value with input after encode and decode
     *
     * @return void
     */
    public function testItShouldReturnSameValueAfterEncodeAndDecode()
    {
        $driver = new OptimusDriver([
            'prime' => 2019110711,
            'inverse' => 1464972935,
            'random' => 1388954641,
        ]);
        $input = 123456;
        $encoded = $driver->encode($input);
        $decoded = $driver->decode($encoded);

        $this->assertNotSame($input, $encoded);
        $this->assertSame($input, $decoded);
    }
}
