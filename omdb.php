<?php

print '
<h1>Vrijeme</h1>';

 $url = "https://api.openweathermap.org/data/2.5/weather?q=Nova Gradiška&appid=28684b5bb4880e2595d2fc1acd68a5ec";
$json = file_get_contents($url);
$json_data = json_decode($json,true); 

print '<div id="openweathermap-widget-21"></div>';



print '</div>';
?>

<script src='//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/d3.min.js'>
</script><script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = []; 
 window.myWidgetParam.push({id: 21,cityid: '3194449',
 appid: '28684b5bb4880e2595d2fc1acd68a5ec',units: 'metric',containerid: 'openweathermap-widget-21',  }); 
 (function() {var script = document.createElement('script');
 script.async = true;script.charset = "utf-8";
 script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";
 var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>