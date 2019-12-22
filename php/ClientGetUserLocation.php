<?php

    $json = file_get_contents('http://www.geoplugin.net/json.gp?ip=**.***.***.**');
    //$json = file_get_contents('http://www.geoplugin.net/json.gp?ip='.$_SERVER['HTTP_X_REAL_IP']);
    
    echo $json;
?>

