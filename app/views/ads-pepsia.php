<?php

$ads = array(
    '<!-- Pepsia Player discoduroderoer.es -->
    <div class="pepsia_player" data-token="00Zy" data-mute="1" data-logo="1" data-controls="1" data-corner="bottom-left" data-popup="0" data-volume="1" data-autoplay="1" data-vid="05WK" data-cid="0"></div>
    <script type="text/javascript">(function(){var e=document.createElement("script"),f=document.getElementsByTagName("script")[0];e.src="//player.pepsia.com/sdk.js?d="+(new Date).getTime().toString(16);e.type="text/javascript";e.async=!0;f.parentNode.insertBefore(e,f);})();</script>',
    '<!-- Pepsia Player discoduroderoer.es -->
    <div class="pepsia_player" data-token="00Zy" data-mute="1" data-logo="1" data-controls="1" data-corner="bottom-left" data-popup="0" data-volume="1" data-autoplay="1" data-vid="05ru" data-cid="0"></div>
    <script type="text/javascript">(function(){var e=document.createElement("script"),f=document.getElementsByTagName("script")[0];e.src="//player.pepsia.com/sdk.js?d="+(new Date).getTime().toString(16);e.type="text/javascript";e.async=!0;f.parentNode.insertBefore(e,f);})();</script>',
    '<!-- Pepsia Player discoduroderoer.es -->
    <div class="pepsia_player" data-token="00Zy" data-mute="1" data-logo="1" data-controls="1" data-corner="bottom-left" data-popup="0" data-volume="1" data-autoplay="1" data-vid="05DO" data-cid="0"></div>
    <script type="text/javascript">(function(){var e=document.createElement("script"),f=document.getElementsByTagName("script")[0];e.src="//player.pepsia.com/sdk.js?d="+(new Date).getTime().toString(16);e.type="text/javascript";e.async=!0;f.parentNode.insertBefore(e,f);})();</script>'
);

$random = rand(0, count($ads) - 1);

echo $ads[$random];
