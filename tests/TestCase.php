<?php

namespace Tests;

use Illuminate\Support\Facades\Route;
use Laravel\FakeId\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Tests\Stubs\Post;

/**
 * Class TestCase
 *
 * @package     Tests
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
abstract class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
