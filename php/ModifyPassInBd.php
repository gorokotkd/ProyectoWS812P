<?php
    if($_REQUEST['pass']===$_REQUEST['pass2']){
    include 'DbConfig.php';
    $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
    if(!$mysqli){
        die("Fallo al conectar con Mysql: ".mysqli_connect_error());
    }
    $hashed_password = password_hash($_REQUEST['pass'], PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET pass='".$hashed_password."' WHERE email='".$_REQUEST['email']."';";
    $resul = mysqli_query($mysqli,$sql);
    if(!$resul){
        die("Error al intentar cambiar la contraseña.");
    }else{
        echo "<h3 style=\"color: green\">La tarea se ha realizado correctamente.</h3>";
        echo "<h4> Ya puede iniciar sesion a traves del siguiente <a href=\"LogIn.php\">enlace.</a></h4>";
    }
    }else{
    echo "<h3 style=\"color: red\">Las contraseñas no coinciden.</h3>";
    }
?>