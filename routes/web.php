<?php

use Jgile\Clip\Http\Controllers\ClipController;

\Illuminate\Support\Facades\Route::get(config('clip.base_url').'/{path}', ClipController::class)->where('path', '.*')->name('clip-img');
