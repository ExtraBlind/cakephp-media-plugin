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
        if (!Configure::read('Extrablind.Media.galleries.dir')) {
            throw new \Exception("Unable to find gallery root dir please provide the following configuration 'Extrablind.Media.galleries.dir' in app.php");
        }
        return;
    }

    private function getPath($name)
    {
        return Configure::read('Extrablind.Media.galleries.dir')."$name";
    }

    public function getUrls($name, $options)
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

    public function getImagePathForGalleryByIndex($name, $index = 0)
    {
        $return = [];
        $path   = $this->getPath($name);
        $imgs   = glob("$path/*.{jpg,png,gif}", GLOB_BRACE);
        $return = '/'.str_replace(WWW_ROOT, '', $imgs[0]);

        foreach ($imgs as $k => $img) :
            if ($k == $index) :
                return $img = '/'.str_replace(WWW_ROOT, '', $img);
            endif;
        endforeach;
        return false;
    }

    public function display($name, $thumbOptions = [], $bigOptions)
    {
        $path = $this->getPath($name);
        if (empty($name)) {
            throw new \Exception("No name provided for the gallery");
        }
        if (!is_dir($path)) {
            throw new \Exception(__("Path {0} does not exists", $path));
        }

        $return = '';
        $return.='<ul>'.PHP_EOL;
        foreach ($this->getUrls($name, $bigOptions) as $k => $url) :
            if ($k == 0):
                $return.= "\t".'<li>'.$this->Html->image($url).'</li>'.PHP_EOL;
            endif;
            $return.= "\t".'<li>'.$this->Html->link($url).'</li>'.PHP_EOL;
        endforeach;
        $return.='</ul>';

        return $return;
    }
}