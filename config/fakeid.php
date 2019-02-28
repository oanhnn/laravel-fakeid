<?php

return [
    /**
     * Default driver name
     */
    'default' => 'main',

    /**
     * Driver's config
     */
    'drivers' => [
        'main' => [
            'driver' => 'base64',
            'options' => [],
        ],

        'other' => [
            'driver' => 'hashids',
            'options' => [],
        ],
    ],
];
