# cakephp-media-plugin
Wrapper around Burzum imagine plugin. 

With this plugin you can : 
  Easily display all images from a specific directory. 
  Display as fancybox galleries
  Resize image as you want
  Cache the resized images

## Install
composer require extrablind/cakephp-media-plugin

Add to your bootstrap.php
Plugin::load('Extrablind/Media', [ 'routes' => true]);



Add to your app.php

'Extrablind.Media.galleries.dir' => WWW_ROOT . 'img/galleries/',
'Imagine.salt' => 'A random string'
