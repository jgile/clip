<?php

namespace Jgile\Clip;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Clip
{
    protected array $query = [];
    protected string $storageUrl;
    protected string $src;

    public function __construct(string $src = '', $query = [])
    {
        $this->storageUrl = trim(Storage::disk(config('filesystems.default'))->url(''), '/');
        $this->query($query)->src($src);
    }

    public function src(string $src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Set query params by array.
     *
     * @param array $query
     * @return $this
     */
    public function query(array $query = [])
    {
        $this->query = collect($query)->filter(function ($val) {
            return $val !== false;
        })->toArray();

        return $this;
    }

    /**
     * Add query parameter.
     *
     * @param $key
     * @param $value
     */
    public function addParameter($key, $value)
    {
        if ($value) {
            $this->query[$key] = $value;
        }
    }

    /**
     * Get the image url.
     *
     * @return string
     */
    public function url()
    {
        $this->query['path'] = (string)Str::of($this->src)->afterLast($this->storageUrl . '/');

        return route('clip-img', $this->query);
    }
}
