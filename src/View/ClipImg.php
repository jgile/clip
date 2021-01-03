<?php

namespace Jgile\Clip\View;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Jgile\Clip\Clip;

class ClipImg extends Component
{
    public string $src;

    /**
     * ClipImg constructor.
     * @param Clip $clip
     * @param $src
     * @param bool $h
     * @param bool $w
     * @param false $fit
     * @param bool $or
     * @param false $flip
     * @param false $crop
     * @param false $dpr
     * @param bool $bri
     * @param bool $con
     * @param bool $gam
     * @param bool $sharp
     * @param false $blur
     * @param bool $pixel
     * @param bool $filt
     * @param false $bg
     * @param false $border
     * @param bool $q
     * @param bool $fm
     */
    public function __construct(
        Clip $clip,
        $src,
        $h = false,
        $w = false,
        $fit = false,
        $or = false,
        $flip = false,
        $crop = false,
        $dpr = false,
        $bri = false,
        $con = false,
        $gam = false,
        $sharp = false,
        $blur = false,
        $pixel = false,
        $filt = false,
        $bg = false,
        $border = false,
        $q = false,
        $fm = false
    ) {
        $this->src = $clip->src($src)->query([
            'h' => $h,
            'w' => $w,
            'fit' => $fit,
            'or' => $or,
            'flip' => $flip,
            'crop' => $crop,
            'dpr' => $dpr,
            'bri' => $bri,
            'con' => $con,
            'gam' => $gam,
            'sharp' => $sharp,
            'blur' => $blur,
            'pixel' => $pixel,
            'filt' => $filt,
            'bg' => $bg,
            'border' => $border,
            'q' => $q,
            'fm' => $fm,
        ])->url();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('clip::components.clip-img');
    }
}
