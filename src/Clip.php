<?php

namespace Jgile\Clip;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Server;
use League\Glide\ServerFactory;

class Clip
{
    /** @var Filesystem */
    protected Filesystem $filesystem;

    /** @var Server */
    protected Server $server;

    /**
     * Clip constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param array $config
     * @return Server
     */
    public function server($config = [])
    {
        if (!isset($this->server)) {
            $this->server = ServerFactory::create(array_merge([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => $this->filesystem->getDriver(),
                'cache' => $this->filesystem->getDriver(),
                'source_path_prefix' => config('clip.source_path_prefix'),
                'cache_path_prefix' => config('clip.cache_path_prefix'),
                'base_url' => config('clip.base_url'),
                'presets' => config('clip.presets'),
            ], $config));

            $this->server->setGroupCacheInFolders(false);
            $this->server->setCacheWithFileExtensions(true);
        }

        return $this->server;
    }

    /**
     * @return Filesystem
     */
    public function filesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param $src
     * @param $query
     * @return string
     */
    public function url($src, $query)
    {
        $query = array_filter($query);
        $query['path'] = $src;

        return $this->filesystem()->url($this->server()->getCachePath($this->normalizePath($src), $query)) . "?" . http_build_query($query);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getImageResponse(Request $request)
    {
        return $this->server()->getImageResponse($this->normalizePath($request->get('path')), $request->all());
    }

    /**
     * @param $path
     * @return string|string[]
     */
    protected function normalizePath($path)
    {
        $srcPath = parse_url($path)['path'];
        $rootPath = parse_url($this->filesystem()->url(''))['path'];

        return str_replace($rootPath, '', $srcPath);
    }
}