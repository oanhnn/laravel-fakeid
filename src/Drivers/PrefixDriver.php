<?php

namespace Laravel\FakeId\Drivers;

use Laravel\FakeId\Contracts\Driver;

/**
 * Class PrefixDriver
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class PrefixDriver implements Driver
{
    /**
     * Prefix
     *
     * @var string
     */
    protected $prefix;

    /**
     * Constructor
     *
     * @param  array $config
     */
    public function __construct(array $config)
    {
        $this->prefix = $config['prefix'] ?? '';
    }

    /**
     * Encode the data.
     *
     * @param  string $data
     * @return string
     */
    public function encode($data)
    {
        return $this->prefix . $data;
    }

    /**
     * Decode the data.
     *
     * @param  string $data
     * @return string
     */
    public function decode($data)
    {
        return substr($data, strlen($this->prefix));
    }
}
