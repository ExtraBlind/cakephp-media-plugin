<?php
$this->Html->css([
    'Extrablind/Media./js/fancybox/source/jquery.fancybox.css?v=2.1.5',
    'Extrablind/Media./js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5',
    'Extrablind/Media./js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7',
    ], ['block' => 'css']);

$this->Html->script([
    'Extrablind/Media./js/jquery-1.11.1.js',
    'Extrablind/Media./js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
    'Extrablind/Media./js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5',
    'Extrablind/Media./js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5',
    'Extrablind/Media./js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6',
    'Extrablind/Media./js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7',
    ], ['block' => 'script']);

echo $this->fetch('content');
