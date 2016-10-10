<?php

namespace Extrablind\Media\View\Helper;

use Cake\Routing\Router;
use Burzum\Imagine\View\Helper\ImagineHelper as BurzumImagineHelper;

class ImagineHelper extends BurzumImagineHelper
{

    public function url($url = null, $full = false, $options = [])
    {
        if (is_string($url)) {
            $url = array_merge([
                'plugin'     => 'Extrablind/Media',
                'prefix'     => false,
                'controller' => 'media',
                'action'     => 'image'],
                # Add urlencode for apache servers
                [urlencode($url)]
            );
        }

        // Backward compatibility check, switches params 2 and 3
        if (is_bool($options)) {
            $tmp     = $options;
            $options = $full;
            $full    = $tmp;
        }

        $options         = $this->pack($options);
        $options['hash'] = $this->hash($options);

        $url = array_merge((array) $url, $options + ['base' => false]);
        return Router::url($url, $full);
    }
}