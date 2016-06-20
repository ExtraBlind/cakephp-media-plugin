<?php

namespace Extrablind\Media\View\Helper;

use Extrablind\Media\View\Helper\ImagineHelper;

class FancyboxHelper extends ImagineHelper
{
    public $helpers = [
        'Extrablind/Media.Imagine',
        'Extrablind/Media.Gallery',
        'Html'
    ];

    public function display($name, $thumbOption = [], $bigsOptions = [])
    {
        if (empty($thumbOption)) {
            [
                'squareCenterCrop' => [
                    'size' => 200
                ]
            ];
        }
        if (empty($bigsOptions)) {
            [
                'thumbnail' => [
                    'height' => 2000,
                    'width'  => 2000
                ]
            ];
        }
        $first   = $this->Gallery->getImagePathForGalleryByIndex($name, 0);
        $first   = $this->Imagine->url($first, false, $thumbOption);
        $options = [
            'thumbnail' => [
                'height' => 1000,
                'width'  => 1000
            ]
        ];
        $imgs    = ($this->Gallery->getUrls($name, $bigsOptions));
        echo '<a class="fancybox" href = "'.$imgs[0].'" rel = "fancyboxGallery_'.$name.'">'.$this->Html->image($first).'</a>';
        array_shift($imgs);
        foreach ($imgs as $link) {
            echo '<a class="fancybox" href = "'.$link.'" rel = "fancyboxGallery_'.$name.'"></a>';
        }
    }
}