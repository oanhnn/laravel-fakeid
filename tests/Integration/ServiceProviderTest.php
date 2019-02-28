<?php

namespace Tests\Integration;

use Illuminate\Filesystem\Filesystem;
use Laravel\FakeId\ServiceProvider;
use Tests\TestCase;

/**
 * Class ServiceProviderTest
 *
 * @package     Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class ServiceProviderTest extends TestCase
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Set up before test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();
    }

    /**
     * Clear up after test
     */
    protected function tearDown(): void
    {
        $this->files->delete([
            $this->app->configPath('fakeid.php'),
        ]);

        parent::tearDown();
    }

    /**
     * Tests config file is existed in config directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\FakeId\\ServiceProvider" --tag=laravel-fakeid-config
     *
     * @test
     */
    public function it_will_publish_vendor_config()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/config/fakeid.php';
        $targetFile = base_path('config/fakeid.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\FakeId\\ServiceProvider',
            '--tag' => 'laravel-fakeid-config',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals(file_get_contents($sourceFile), file_get_contents($targetFile));
    }

    /**
     * Test config values are merged
     *
     * @test
     */
    public function it_provides_default_config()
    {
        $config = config('fakeid');

        $this->assertTrue(is_array($config));
        $this->assertArrayHasKey('default', $config);
        $this->assertTrue(is_string($config['default']));

        $this->assertArrayHasKey('drivers', $config);
        $this->assertTrue(is_array($config['drivers']));
        $this->assertArrayHasKey($config['default'], $config['drivers']);
    }

    /**
     * Test manager is bound in application container
     *
     * @test
     */
    public function it_bound_some_services()
    {
        $classes = (new ServiceProvider($this->app))->provides();

        foreach ($classes as $class) {
            $this->assertTrue($this->app->bound($class));
            if (class_exists($class)) {
                $this->assertInstanceOf($class, $this->app->make($class));
            }
        }
    }
}
