<?php
    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');
    
    $ns = "https://".$_SERVER['HTTP_HOST']."/ProyectoWS19G18/lib";
    $server = new soap_server;
    $server->configureWSDL('ObtenerPregunta',$ns);
    $server->wsdl->schemaTargetNamespace = $ns;

    /*
    DATOS QUE QUIERO DEVOLVER CON EL SERVICIO:
    ID de la pregunta
    ENCUNCIADO de la pregunta
    RESPUESTA CORRECTA
    EMAIL del autor
    */
    $server->wsdl->addComplextype(
        'datosPregunta',
        'complexType',
        'struct',
        'all',
        '',
        array(
            'clave' => array('name'=>'clave','type'=>'xsd:integer'),
            'email' => array('name'=>'email','type'=>'xsd:string'),
            'enunciado' => array('name'=>'enunciado','type'=>'xsd:string'),
            'respuestac' => array('name'=>'respuestac','type'=>'xsd:string'),
        )
    );

    $server->register('obtenerPregunta',
                     array('id'=>'xsd:integer','ticket'=>'xsd:string'),
                     array('return'=>'tns:datosPregunta'),
                     $ns);

    function obtenerPregunta($id,$ticket){
       if($ticket==="1010"){
           include '../php/DbConfig.php';
           $link = mysqli_connect($server,$user,$pass,$basededatos);
            if(!$link){
                die("Fallo al conectar con la base de datos: " .mysqli_connect_error());
            }

            $sql = "SELECT clave, email, enunciado, respuestac FROM preguntas WHERE clave={$id};";
            $resul = mysqli_query($link,$sql);
            
            $resul_array = mysqli_fetch_array($resul);
            mysqli_close($link);
           if(empty($resul_array)){
               $resul_array = array('clave'=>'-1','email'=>'',''=>'',''=>'');
           }
           
           
            return $resul_array;
       }
    }

    if(!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA  = file_get_contents('php://input');
    $server->service($HTTP_RAW_POST_DATA);
?>