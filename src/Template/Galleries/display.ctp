

<?php

use Cake\Core\Configure;

$this->extend('Extrablind/Media./includes');
?>
<h1>Galleries</h1>
<hr>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
</script>
<?php
$thumb = [
    'squareCenterCrop' => [
        'size' => 190
    ]
];



$config = Configure::read('Extrablind.Media.galleries.dir')."*";
$glob   = glob($config, GLOB_BRACE);

foreach ($glob as $dir):
    $end = explode('/', realpath($dir));
    echo $this->Fancybox->display(end($end), $thumb);
endforeach;
?>
<style>
    li{
        list-style: none;
    }
    img{
        float:left;
    }
</style>