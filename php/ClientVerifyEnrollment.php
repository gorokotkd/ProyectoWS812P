<?php 
    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    
    $soapClient = new nusoap_client('https://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl', true);
    
    $err = $soapClient->getError();
    if($err){   echo 'Error al crear el cliente: '.$err;    }
    
    $param = array('x' => $_REQUEST['dirCorreo']);

    echo $soapClient->call('comprobar',$param);



?>