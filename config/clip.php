<?php

return [
    'presets' => [
        'thumb' => [
            'w' => 100,
            'h' => 100,
        ],
        'small' => [
            'w' => 400,
            'h' => 400,
        ],
        'medium' => [
            'w' => 600,
            'h' => 600,
        ],
    ],
    'defaults' => [],
    'disk' => env('CLIP_DISK', env('MEDIA_DISK', env('FILESYSTEM_DRIVER', 'public'))),
    'cache_path_prefix' => 'cache',
    'source_path_prefix' => '',
];
