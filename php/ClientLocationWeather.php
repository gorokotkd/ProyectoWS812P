<?php
    $apikey = "8b1585f5e6826f34aa710149c038a994";
    $json = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?lat={$_GET['lat']}&lon={$_GET['lon']}&APPID={$apikey}&units=metric");
    echo $json;

?>