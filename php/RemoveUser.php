<?php include'../php/Seguridad.php'?>
<?php
    
    include 'DbConfig.php';
    //Creamos la conexion con la BD.
    $link = mysqli_connect($server,$user,$pass,$basededatos);
    if(!$link){
        die("Fallo al conectar con la base de datos: " .mysqli_connect_error());
    }

    $sql = "DELETE FROM usuarios WHERE email = '{$_GET['email']}';";
    $resul = mysqli_query($link,$sql);
    if(!$resul){
        die("Error: ".mysqli_error($link));
    }
    mysqli_close($link);      
?>