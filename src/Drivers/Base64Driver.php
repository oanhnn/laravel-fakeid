<?php

namespace Laravel\FakeId\Drivers;

use Laravel\FakeId\Contracts\Driver;

/**
 * Class Base64Driver
 *
 * @package     Laravel\FakeId\Drivers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class Base64Driver implements Driver
{
    /**
     * Encode the data.
     *
     * @param  string $data
     * @return string
     */
    public function encode($data)
    {
        return \strtr(\base64_encode($data), ['+' => '-', '/' => '_', '=' => '']);
    }

    /**
     * Decode the data.
     *
     * @param  string $data
     * @return string
     */
    public function decode($data)
    {
        return \base64_decode(\strtr($data, ['-' => '+', '_' => '/']), false);
    }
}
