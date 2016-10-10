<?php

use Cake\Routing\Router;

Router::plugin('Extrablind/Media', function ($routes) {
    $routes->connect('/cache/*', ['controller' => 'media', 'action' => 'image']);
    $routes->fallbacks('DashedRoute');
});
