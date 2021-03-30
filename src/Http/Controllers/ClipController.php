<?php

namespace Jgile\Clip\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jgile\Clip\Clip;

class ClipController extends Controller
{
    /**
     * @param Clip $clip
     * @param Request $request
     * @param $path
     * @return mixed
     * @throws \Exception
     */
    public function __invoke(Clip $clip, Request $request, $path)
    {
        return $clip->getImageResponse($request);
    }
}
