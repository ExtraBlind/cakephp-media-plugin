<?php

namespace Extrablind\Media\View\Helper;

use Extrablind\Media\View\Helper\ImagineHelper;
use Cake\Core\Configure;

class GalleryHelper extends ImagineHelper
{
    protected $path;
    public $helpers = [
        'Html',
    ];

    public function __construct(\Cake\View\View $View, array $config = array())
    {
        parent::__construct($View, $config);
    }

    public function initialize(array $config)
    {
        if (!$this->getGalleryDir()) {
            throw new \Exception("Unable to find gallery root dir please provide the following configuration 'Extrablind.Media.galleries.dir' in any of your config file");
        }
        if (!is_dir($this->getGalleryDir())) {
            throw new \Exception(sprintf("The dir %s does not exists. Please create it.", $this->getGalleryDir()));
        }
        return;
    }

    public function getGalleryDir()
    {
        return Configure::read('Extrablind.Media.galleries.dir');
    }

    private function getPath($name)
    {
        return $this->getGalleryDir()."$name";
    }

    public function getUrls($name, $options = [])
    {
        $return = [];
        $path   = $this->getPath($name);
        $imgs   = glob("$path/*.{jpg,png,gif}", GLOB_BRACE);
        foreach ($imgs as $img) :
            $img       = '/'.str_replace(WWW_ROOT, '', $img);
            $return [] = $this->url($img, false, $options);
        endforeach;
        return $return;
    }

    public function getImagePathByGallery($name)
    {
        $return = [];
        $path   = $this->getPath($name);
        $imgs   = glob("$path/*.{jpg,png,gif}", GLOB_BRACE);

        if (empty($imgs)) {
            return [];
        }
        foreach ($imgs as $k => $img) :
            $return[] = '/'.str_replace(WWW_ROOT, '', $img);
        endforeach;
        return $return;
    }
}