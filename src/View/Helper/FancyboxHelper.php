<?php

namespace Extrablind\Media\View\Helper;

use Extrablind\Media\View\Helper\ImagineHelper;

class FancyboxHelper extends ImagineHelper
{
    public $helpers                  = [
        'Extrablind/Media.Imagine',
        'Extrablind/Media.Gallery',
        'Html'
    ];
    private $defaultThumbnailOptions = [
        'squareCenterCrop' => [
            'size' => 200
        ]
    ];
    private $defaultBigOptions       = [
        'thumbnail' => [
            'height' => 2000,
            'width'  => 2000
        ]
    ];

    private function generateUniqueId()
    {
        return md5(rand(0, 999).microtime());
    }

    public function display($images, $thumbOptions = [], $bigsOptions = [])
    {
        $bigsOptions  = array_merge($this->defaultBigOptions, $bigsOptions);
        $thumbOptions = array_merge($this->defaultThumbnailOptions, $thumbOptions);

        if (empty($images)) :
            return '';
        endif;

        $rel = "fancyboxGallery_{$this->generateUniqueId()}";

        # Build first img
        $firstImgUrl = $this->Imagine->url($images[0], false, $thumbOptions);
        $firstImg    = $this->Html->image($firstImgUrl);
        $return      = $this->Html->link($firstImg, $images[0],
            [
            'class'  => 'fancybox',
            'rel'    => $rel,
            'escape' => false
        ]);
        array_shift($images);

        # Others images as link
        foreach ($images as $image) {
            $return .= $this->Html->link('', $this->Imagine->url($image, false, $bigsOptions),
                [
                'class' => 'fancybox',
                'rel'   => $rel,
            ]);
        }
        return $return;
    }
}