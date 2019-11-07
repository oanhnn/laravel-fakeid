<?php

namespace Laravel\FakeId\Drivers;

use Hashids\Hashids;
use Laravel\FakeId\Contracts\Driver;

/**
 * Class HashidsDriver
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 *
 * @see https://github.com/vinkla/hashids
 */
class HashidsDriver implements Driver
{
    /**
     * The Hashids instance.
     *
     * @var \Hashids\Hashids
     */
    protected $hashids;

    /**
     * Create a new Hashids driver instance.
     *
     * @param  array $config
     */
    public function __construct(array $config = [])
    {
        $this->hashids = new Hashids(
            $config['salt'] ?? '',
            $config['min_length'] ?? 0,
            $config['alphabet'] ?? 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        );
    }

    /**
     * Encode the data.
     *
     * @param  array $data
     * @return string
     */
    public function encode($data)
    {
        return $this->hashids->encode($data);
    }

    /**
     * Decode the data.
     *
     * @param  string $data
     * @return array
     */
    public function decode($data)
    {
        return $this->hashids->decode($data);
    }
}
