<?php

namespace Extrablind\Media\View;

use App\View\AppView as BaseAppView;

class AppView extends BaseAppView
{

    public function initialize()
    {
        $this->loadHelper('Burzum/FileStorage.Image');
        $this->loadHelper('Extrablind/Media.Imagine');
        $this->loadHelper('Extrablind/Media.Gallery');
        $this->loadHelper('Extrablind/Media.Fancybox');
    }
}