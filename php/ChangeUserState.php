<?php
    
    include 'DbConfig.php';
    //Creamos la conexion con la BD.
    $link = mysqli_connect($server,$user,$pass,$basededatos);
    if(!$link){
        die("Fallo al conectar con la base de datos: " .mysqli_connect_error());
    }

    $sql = "UPDATE usuarios SET activo = NOT(activo) WHERE email = '{$_GET['email']}';";
    $resul = mysqli_query($link,$sql);
    if(!$resul){
        die("Error: ".mysqli_error($link));
    }

    
    $sql = "SELECT * FROM usuarios WHERE email='{$_GET['email']}';";
    $resul = mysqli_query($link, $sql, MYSQLI_USE_RESULT);
    if(!$resul){
        die("Error: ".mysqli_error($link));
    }

    $row = mysqli_fetch_array($resul);
    $activo = "Activo";
    if($row['activo']==0){
        $activo = "Bloqueado";
    }
    echo "<tr id=".$row['email']."><td>".$row['email']."</td><td>".$row['pass']."</td><td><img width=\"50\" height=\"50\" src=\"data:image/*;base64, ".$row['foto']."\" alt=\"Imagen\"/></td><td>".$activo."</td><td><input type=\"button\" onclick=\"changeStatus(this)\" id=\"estado-button-{$row['email']}\" value=\"Cambiar Estado\"/></td><td><input type=\"button\" id=\"borrar-button-{$row['email']}\" value=\"Eliminar Usuario\"/></td></tr>";

    mysqli_close($link);      
?>