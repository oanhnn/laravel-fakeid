<?php

namespace Tests\Concerns;

/**
 * Trait WithTestDatabase
 *
 * Help test with test database
 *
 * @package     Tests\Concerns
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
trait WithTestDatabase
{
    /**
     * Setting up test database.
     *
     * @return void
     */
    protected function setUpTestDatabase()
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('body')->nullable();
            $table->softDeletes();
        });

        // TODO: seed database
    }
}
