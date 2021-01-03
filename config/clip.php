<?php

return [
    'presets' => [
        'thumb' => [
            'w' => 100,
            'h' => 100,
            'fit' => 'crop',
        ],
        'small' => [
            'w' => 200,
            'h' => 200,
            'fit' => 'crop',
        ],
        'medium' => [
            'w' => 600,
            'h' => 400,
            'fit' => 'crop',
        ],
    ],
    'disk' => env('CLIP_DISK', env('FILESYSTEM_DRIVER', 'local')),
    'base_url' => env('CLIP_BASE_URL', 'clip'),
    'replace_url' => env('CLIP_REPLACE_URL', 'storage'),
    'cache_path' => env('CLIP_CACHE_PATH', '.cache'),
    'source_path' => env('CLIP_SOURCE_PATH', 'public'),
];
