<?php
    return [
        'view'   => [
            'view_directory' => 'app/views/'
        ],
        'images' => [
            'storage_path' => 'storage/',
            'sizes'        => [
                'base'   => [
                    [
                        'width'  => 640,
                        'height' => 480,
                        'prefix' => 'middle_'
                    ],
                    [
                        'width'  => 320,
                        'height' => 240,
                        'prefix' => 'small_'
                    ]
                ],
                'avatar' => [
                    [
                        'width'  => 100,
                        'height' => 100
                    ]
                ]
            ]
        ],
    ];