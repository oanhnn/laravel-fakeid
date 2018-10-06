<?php

namespace Laravel\FakeId\Contracts;

interface ShouldFakeId
{
    /**
     * @return FakeDriver
     */
    public function getFakeIdDriver(): FakeDriver;
}
