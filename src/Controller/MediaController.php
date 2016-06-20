<?php

namespace Extrablind\Media\Controller;

use App\Controller\AppController as BaseController;
use Burzum\Imagine\Lib\ImageProcessor;
use Cake\Core\Plugin;
use Cake\Network\Exception\NotFoundException;

class MediaController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Burzum/Imagine.Imagine');
    }

    public function image($file = null)
    {
        $file = WWW_ROOT.$file;
        # Check cache
        if (!is_file($file)) {
            throw new NotFoundException(sprintf("No file specified or not found. %s", $file));
        }

        $this->response->modified(filemtime($file));
        if ($this->response->checkNotModified($this->request)) {
            return $this->response;
        }

        # Init
        unset($this->request->query['hash']);
        $params        = $this->Imagine->unpackParams();
        $fileMd5       = md5_file($file);
        $imagineHash   = substr($this->Imagine->getHash(), 0, 6);
        $cachedFileDir = WWW_ROOT."img/cache/{$imagineHash}";

        if (!is_dir($cachedFileDir)) {
            mkdir($cachedFileDir, 0777);
        }

        # Process not cached image
        $cachedFilePath = "{$cachedFileDir}/{$fileMd5}";
        $isNotCached    = !is_file($cachedFilePath);
        if ($isNotCached) {
            $processor = new ImageProcessor();
            $processor->open($file);
            $processor->batchProcess($cachedFilePath, $params);
            $this->response->cache('-1 minute', '+365 days');
        }
        # Return appropriate response
        $infos = new \Cake\Filesystem\File($cachedFilePath);
        $infos = $infos->info();
        $this->response->type($infos['mime']);
        $this->response->body(file_get_contents($cachedFilePath));
        return $this->response;
    }
}