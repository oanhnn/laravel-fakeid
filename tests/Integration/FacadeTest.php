<?php

namespace Tests\Integration;

use InvalidArgumentException;
use Laravel\FakeId\Contracts\Driver;
use Laravel\FakeId\Facades\FakeId;
use Laravel\FakeId\Contracts\Manager;
use Laravel\FakeId\Drivers\Base64Driver;
use Laravel\FakeId\Drivers\HashidsDriver;
use Laravel\FakeId\Drivers\HexDriver;
use Laravel\FakeId\Drivers\OptimusDriver;
use Laravel\FakeId\Drivers\PrefixDriver;
use Tests\Stubs\CustomDriver;
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
     * Test facade should resolve a FakeId manager object
     *
     * @return void
     */
    public function testItShouldResolveManagerObject()
    {
        $obj = FakeId::getFacadeRoot();

        $this->assertInstanceOf(Manager::class, $obj);
    }

    /**
     * Test facade should resolve driver object
     *
     * @return void
     */
    public function testItShouldResolveDriverObject()
    {
        $this->assertInstanceOf(Base64Driver::class, FakeId::driver('base64'));
        $this->assertInstanceOf(HexDriver::class, FakeId::driver('hex'));
        $this->assertInstanceOf(HashidsDriver::class, FakeId::driver('hashids'));
        $this->assertInstanceOf(OptimusDriver::class, FakeId::driver('main'));
        $this->assertInstanceOf(PrefixDriver::class, FakeId::driver('other'));
    }

    /**
     * Test facade should throw exception when it cannot resolve driver
     *
     * @return void
     */
    public function testItShouldThrowExceptionWhenCannotResolveDriver()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Driver [abc] not supported.');

        FakeId::driver('abc');
    }

    /**
     * Test facade should provide default driver
     *
     * @return void
     */
    public function testItShouldHaveDefaultDriver()
    {
        $this->assertSame('main', FakeId::getDefaultDriver());
    }

    /**
     * Test facade can register custom driver
     *
     * @return void
     */
    public function testItCanRegisterCustomDriver()
    {
        FakeId::extend('custom', function () {
            return new CustomDriver();
        });

        $this->assertInstanceOf(Driver::class, FakeId::driver('custom'));
    }

    /**
     * Test facade can call encode and decode
     *
     * @return void
     */
    public function testItShouldInvokeEncodeAndDecode()
    {
        config()->set('fakeid.default', 'base64');

        $input = '123456';
        $encoded = FakeId::encode($input);
        $decoded = FakeId::decode($encoded);

        $this->assertSame($input, $decoded);
    }
}
