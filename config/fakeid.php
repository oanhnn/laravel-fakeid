<?php

return [

    'default' => '',
    'connections' => [
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
