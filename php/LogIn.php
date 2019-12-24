<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

     <h2>Inicio de sesion.</h2>
      
      <div>
         <form action="LogIn.php" name="flogin" id="flogin" method="post" enctype="multipart/form-data">
            <p>Introduce tu dirección de correo: *</p>
            <input type="email" size="60" id="dirCorreo" name="dirCorreo" required >
            <p>Contraseña: *</p>
            <input type="password" size="60" id="pass" name="pass" required>
            <p> <input type="submit" id="submit" value="Enviar"> <input type="reset" value="Limpiar"></p>
            <p>Si no recuerdas tu contraseña haz click <a href="RestorePass.php">aqui.</a></p>
        </form>
      </div>
      
    </div>
      
      <div>
        <?php
            if(isset($_REQUEST['dirCorreo'])){
                include 'DbConfig.php';
                
                $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
                if(!$mysqli){
                    die("Fallo al conectar con Mysql: ".mysqli_connect_error());
                }
                $email = $_REQUEST['dirCorreo'];
                $pass = $_REQUEST['pass'];
                
                $sql = "SELECT * FROM usuarios WHERE email='$email';";
                
                $resultado = mysqli_query($mysqli,$sql,MYSQLI_USE_RESULT);
                if(!$resultado){
                    die("Error: ".mysqli_error($mysqli));
                }
                $row = mysqli_fetch_array($resultado);
                if(($row['email']==$email)and(hash_equals($row['pass'],crypt($pass,$row['pass'])))){
                    if($row['activo']){
                        session_start();

                        $_SESSION['identificado']="SI";
                        $_SESSION['email'] = $row['email'];

                        if($row['email'] == "admin@ehu.es"){
                            $_SESSION['tipo'] = "admin";
                        }else{
                            $_SESSION['tipo'] = "user";
                        }

                        echo "<script>
                        alert('Inicio de sesion realizado correctamente. Pulsa aceptar para acceder a la pantalla principal.');
                        window.location.href='IncreaseGlobalCounter.php';
                        </script>"; 
                    }else{
                        echo "Este usuario no tiene permitido acceder. <br>";
                        echo "<a href=\"javascript:history.back()\">Volver a atras</a>";
                    }
                }else{
                    $_SESSION['identificado'] = "NO";
                    echo "Usuario o contraseña incorrectos, prueba de nuevo. <br>";
                    echo "<a href=\"javascript:history.back()\">Volver a atras</a>";
                }
                
            }
    
    
        ?>
      
      </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
