<?php
    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    
    $ns = "http://".$_SERVER['HTTP_HOST']."/ProyectoWS19G18/lib";
    $server = new soap_server;
    $server->configureWSDL('verificar',$ns);
    $server->wsdl->schemaTargetNamespace = $ns;

    $server->register('verificar',
                     array('x'=>'xsd:string','ticket'=>'xsd:string'),
                     array('y'=>'xsd:string'),
                     $ns);

    function verificar($x,$ticket){
       if($ticket==="1010"){
            $coincidencia = false;
            $fp = fopen("../txt/toppasswords.txt", "r");
            while (!feof($fp)){
                $linea = fgets($fp);
                $linea = trim($linea);
                if($linea===$x){
                    $coincidencia = true;
                }
            }
            fclose($fp);
            if($coincidencia===false){
                return "VALIDA";
            }else{
                return "INVALIDA";
            }
       }else{
           return "INVALIDA";
       }
    }

    if(!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA  = file_get_contents('php://input');
    $server->service($HTTP_RAW_POST_DATA);
?>