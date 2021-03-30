<?php

use Jgile\Clip\Http\Controllers\ClipController;

$urlParts = parse_url(\Illuminate\Support\Facades\Storage::disk(config('clip.disk'))->url(config('clip.cache_path_prefix')));
$url = trim($urlParts['path'], '/');

\Illuminate\Support\Facades\Route::get($url . '/{path}', ClipController::class)->where('path', '.*')->name('clip-img');