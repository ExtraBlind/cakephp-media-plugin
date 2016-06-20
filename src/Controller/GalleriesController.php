<?php

namespace Extrablind\Media\Controller;

use App\Controller\AppController as BaseController;
use Burzum\Imagine\Lib\ImageProcessor;
use Cake\Core\Plugin;

class GalleriesController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Burzum/Imagine.Imagine');
    }

    public function display($params = null)
    {
        return;
    }
}