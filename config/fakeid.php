<?php

use Laravel\FakeId\Drivers\PrefixDriver;

return [
    /**
     * Default driver name
     */
    'default' => 'main',

    /**
     * Driver's config
     */
    'drivers' => [
        // Driver without config
        'base64' => [],

        // Driver with specific driver
        'main' => [
            'driver' => 'optimus',
            'prime' => 2019110711,
            'inverse' => 1464972935,
            'random' => 1388954641,
        ],

        // Driver with specific driver by class name
        'other' => [
            'driver' => PrefixDriver::class,
            'prefix' => 'fake',
        ],
    ],
];
