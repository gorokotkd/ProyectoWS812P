<?php
    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');

    $ticket = "1010";
    
    $soapclient = new nusoap_client('https://'.$_SERVER['HTTP_HOST'].'/ProyectoWS812P/lib/verifyPassWS.php?wsdl',true);

    $err = $soapclient->getError();
    if($err){   echo 'Error al crear el cliente: '.$err;    }
    
    $param = array('x' => $_REQUEST['pass'], 'ticket' => $ticket);

    echo $soapclient->call('verificar',$param);

  /*  echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
    echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
    echo '<h2>Debug</h2>';
    echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';*/
    
?>