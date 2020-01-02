<?php
    if(isset($_REQUEST['id'])){
        include 'DbConfig.php';

        $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
        if(!$mysqli){
            die("Fallo al conectar con Mysql: ".mysqli_connect_error());
        }
        
        $sql = "UPDATE preguntas SET dislikes = dislikes + 1 WHERE clave = {$_REQUEST['id']}";
        
        $resultado = mysqli_query($mysqli,$sql);
        if(!$resultado){
            die("Error: ".mysqli_error($mysqli));
        }
    }
?>