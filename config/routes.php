<?php

use Cake\Routing\Router;

Router::plugin(
    'Extrablind/Media', ['path' => '/media'],
    function ($routes) {
    $routes->connect('/cache/*', ['plugin' => 'Extrablind/Media', 'controller' => 'media', 'action' => 'image']);
    $routes->fallbacks('DashedRoute');
});
