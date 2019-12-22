<?php include'../php/Seguridad.php'?>
<?php
    if($_SESSION['tipo']=="user"){
        header('location:Layout.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ChangeUserStatusAjax.js"></script>
    <script src="../js/DeleteUserAjax.js"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
        <?php
            include 'DbConfig.php';
            $link = mysqli_connect($server,$user,$pass,$basededatos);
    
            if(!$link){
                die("Fallo al conectar con la base de datos: " .mysqli_connect_error());
            }
    
            $sql = "SELECT * FROM usuarios;";
            $resul = mysqli_query($link,$sql,MYSQLI_USE_RESULT);
            if(!$resul){
                die("Error: ".mysqli_error($link));
            }

            echo "<table border = 1 style=\"margin-right:auto; margin-left:auto\" id=\"users\"><tr><th>Email</th><th>Pass</th><th>Imagen</th><th>Estado</th><th>Cambiar Estado</th><th>Borrar Usuario</th></tr>";
            while($row = mysqli_fetch_array($resul)){
                $activo = "Activo";
                if($row['activo']==0){
                    $activo = "Bloqueado";
                }
                echo "<tr id=".$row['email']."><td>".$row['email']."</td><td>".$row['pass']."</td><td><img width=\"50\" height=\"50\" src=\"data:image/*;base64, ".$row['foto']."\" alt=\"Imagen\"/></td><td>".$activo."</td><td><input type=\"button\" onclick=\"changeStatus(this)\" id=\"estado-button-{$row['email']}\" value=\"Cambiar Estado\"/></td><td><input type=\"button\" onclick=\"deleteUser(this)\" id=\"borrar-button-{$row['email']}\" value=\"Eliminar Usuario\"/></td></tr>";
            }
            echo "</table>";
            mysqli_close($link);
        ?>
    </div>
      
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>