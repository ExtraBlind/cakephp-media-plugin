<?php

namespace Extrablind\Media\Controller;

use App\Controller\AppController as BaseController;

class GalleriesController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Burzum/Imagine.Imagine');
    }

    public function index($params = null)
    {
        return;
    }
}