<?php
    if(isset($_REQUEST['id']) && isset($_REQUEST['respuesta'])){
        include 'DbConfig.php';

        $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
        if(!$mysqli){
            die("Fallo al conectar con Mysql: ".mysqli_connect_error());
        }
        
        $sql = "SELECT respuestac FROM preguntas WHERE clave='{$_REQUEST['id']}';";
        
        $resultado = mysqli_query($mysqli,$sql);
        if(!$resultado){
            die("Error: ".mysqli_error($mysqli));
        }

        $row = mysqli_fetch_array($resultado);

        if($_REQUEST['respuesta']===$row['respuestac']){
            echo "true";
        }else{
            echo "false";
        }
    }
?>