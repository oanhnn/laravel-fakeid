<?php

namespace Laravel\FakeId\Drivers;

use InvalidArgumentException;
use Jenssegers\Optimus\Optimus;
use Laravel\FakeId\Contracts\Driver;

/**
 * Class OptimusDriver
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 *
 * @see https://github.com/jenssegers/optimus#usage
 */
class OptimusDriver implements Driver
{
    /**
     * The Optimus instance.
     *
     * @var \Jenssegers\Optimus\Optimus
     */
    protected $optimus;

    /**
     * Create a new Optimus driver instance.
     *
     * @param  array $config
     * @throws \InvalidArgumentException
     */
    public function __construct(array $config)
    {
        if (!isset($config['prime'], $config['inverse'])) {
            throw new InvalidArgumentException('The prime and inverse must be specified.');
        }

        $this->optimus = new Optimus(
            $config['prime'],
            $config['inverse'],
            $config['random'] ?? 0
        );
    }

    /**
     * Encode the data.
     *
     * @param  int $data
     * @return int
     */
    public function encode($data)
    {
        return $this->optimus->encode($data);
    }

    /**
     * Decode the data.
     *
     * @param  int $data
     * @return int
     */
    public function decode($data)
    {
        return $this->optimus->decode($data);
    }
}
