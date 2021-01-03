<?php

namespace Jgile\Clip\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Routing\Controller;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ClipController extends Controller
{
    /**
     * @param Filesystem $filesystem
     * @param $path
     * @return mixed
     */
    public function __invoke(Filesystem $filesystem, $path)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'source_path_prefix' => config('clip.source_path'),
            'cache_path_prefix' => config('clip.cache_path'),
            'base_url' => config('clip.base_url'),
            'presets' => config('clip.presets'),
        ]);

        return $server->getImageResponse($path, request()->all());
    }
}
