<?php

namespace Tests\Integration;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Route;
use Tests\Stubs\Post;
use Tests\TestCase;

/**
 * Class RoutesWithFakeIdTest
 *
 * @package     Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class RoutesWithFakeIdTest extends TestCase
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function testItShouldProvidesRouteKey()
    {
        /** @var Post $post */
        $post = Post::create(['title' => 'Post test']);
        $key = $post->getKey();
        $routeKey = $post->getRouteKey();

        $this->assertNotSame($key, $routeKey);
        $this->assertEquals($key, $post->resolveRouteBinding($routeKey)->getKey());
    }

    public function testItShouldMatchCorrect()
    {
        $post = Post::create(['title' => 'Post test']);
        $uri = route('posts.show', compact('post'), false);

        $this->assertNotSame('/posts/' . $post->getKey(), $uri);

        $response = $this->getJson($uri);
        $response->assertOk();
        $response->assertJson([
            'title' => 'Post test',
        ]);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Set default fake id driver
        $app['config']->set('fakeid.default', 'base64');

        // Set application key
        $app['config']->set('app.key', 'base64:h4jChXVLz64QhbLo54mhWxPNJk9Y9pzCncoPReE+BV0=');

        // Set database connect
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // Create posts table
        $app['db']->connection()->getSchemaBuilder()->create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('body')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Define route
        Route::middleware('web')->get('posts/{post}', function (Post $post) {
            return $post->toArray();
        })->name('posts.show');
    }
}
