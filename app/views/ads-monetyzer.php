<?php





if (!isset($index_ad)) {

    $adsRandom = array(
        '<div id="31343-19"><script src="//ads.themoneytizer.com/s/gen.js?type=19"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=31343&formatId=19" ></script></div>',
        '<div class="outbrain-tm" id="31343-16"><script src="//ads.themoneytizer.com/s/gen.js?type=16"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=31343&formatId=16" ></script></div>',
        '<div id="31343-2"><script src="//ads.themoneytizer.com/s/gen.js?type=2"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=31343&formatId=2" ></script></div>'
    );

    $index_ad = rand(0, count($adsRandom) - 1);
    $ad = $adsRandom[$index_ad];
} else {

    $adsFixed = array(
        '<div id="31343-1"><script src="//ads.themoneytizer.com/s/gen.js?type=1"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=31343&formatId=1" ></script></div>',
        '<div id="31343-28"><script src="//ads.themoneytizer.com/s/gen.js?type=28"></script><script src="//ads.themoneytizer.com/s/requestform.js?siteId=31343&formatId=28" ></script></div>'
    );

    $ad = $adsFixed[$index_ad];
}



?>
<div class="row">
    <div class="col-12 text-center" <?php echo (isset($min_height) ? 'style="min-height: '.$min_height.'px"' : ''); ?>>
        <?php
        echo $ad;
        unset($index_ad);
        unset($min_height);
        ?>
    </div>
</div>