<?php
/*
 * This is the demo page.
 * It takes all folder in defined gallery dir and transform it in fancybox gallery.
 */
# Include all js
$this->extend('Extrablind/Media./includes');
?>
<h1><?php echo __("Galleries") ?></h1>
<hr>
<?php
# Burzum/Imagine plugin options fot thumbnails
# Please follow : https://github.com/burzum/cakephp-imagine-plugin for more detail
$thumb = [
    'squareCenterCrop' => [
        'size' => 190
    ]
];
# Get configured gallery dir
$dir   = $this->Gallery->getGalleryDir();

# Get all galleries dirs in the configured gallery
$glob = glob($dir."*", GLOB_BRACE);

if (empty($glob)) :
    echo sprintf("Dir %s is empty. Please add a folder containing at least one images", $dir);
endif;

foreach ($glob as $dir):
    $end  = explode('/', $dir);
    # Get all images in gallery
    $imgs = $this->Gallery->getImagePathByGallery(end($end));
    # Transform in fancybox
    # You can provide 3 arguments :
    #   1 the images
    #   2 the thumbnail image options (entry point of the gallery) for imagine
    #   3 the big images options for imagine
    echo $this->Fancybox->display($imgs, $thumb);
endforeach;
?>
<script type="text/javascript">
    // Initiate Fancybox
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
</script>