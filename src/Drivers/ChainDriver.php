<?php

namespace Laravel\FakeId\Drivers;

use InvalidArgumentException;
use Laravel\FakeId\Contracts\Driver;

/**
 * Class ChainDriver
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class ChainDriver implements Driver
{
    /**
     * @var \Laravel\FakeId\Contracts\Driver[]
     */
    private $drivers;

    /**
     * Constructor
     *
     * @param array $drivers
     * @throws \InvalidArgumentException
     */
    public function __construct(array $drivers)
    {
        $this->drivers = [];
        foreach ($drivers as $driver) {
            if ($driver instanceof Driver) {
                $this->drivers[] = $driver;
            }
        }

        if (empty($this->drivers)) {
            throw new InvalidArgumentException('List drivers MUST not empty.');
        }
    }

    /**
     * Encode the data.
     *
     * @param  string $data
     * @return string
     */
    public function encode($data)
    {
        return \array_reduce(
            $this->drivers,
            function ($carry, $item) {
                return $item->encode($carry);
            },
            $data
        );
    }

    /**
     * Decode the data.
     *
     * @param  string $data
     * @return string
     */
    public function decode($data)
    {
        return \array_reduce(
            \array_reverse($this->drivers),
            function ($carry, $item) {
                return $item->decode($carry);
            },
            $data
        );
    }
}
