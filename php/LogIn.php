<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta name="google-signin-client_id" content="482385241484-3t98l5bcobkq6mifve3dv5kcgr9gei7n.apps.googleusercontent.com">
   
  <?php include '../html/Head.html'?>
  
  <script>
    function onSuccess(googleUser) {
            gapi.auth2.init();
            var profile = googleUser.getBasicProfile();
            $.ajax({
                type: "GET",
                url: "LogIn.php?dirCorreo="+profile.getEmail()+"&google=OK&img="+profile.getImageUrl(),
                success: function (response) {
                    alert('Inicio de sesion realizado correctamente. Pulsa aceptar para acceder a la pantalla principal.');
                    window.location.href='IncreaseGlobalCounter.php';
                }
            });
        }
    function onFailure(error) {
      console.log(error);
    }
    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });

    gapi.load('auth2', function() {
        gapi.auth2.init({client_id: '482385241484-3t98l5bcobkq6mifve3dv5kcgr9gei7n.apps.googleusercontent.com'});
    });

      
    }
  </script>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

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
            <div style="margin-left: 638.2px"><div id="my-signin2"></div></div>
        </form>
      </div>
    </div>
      <div>
        <?php
            if(isset($_REQUEST['dirCorreo'])){
                if(!isset($_REQUEST['google'])){
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
                            //session_start();

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
                }else{
                    $_SESSION['identificado'] = "SI";
                    $_SESSION['email'] = $_REQUEST['dirCorreo'];
                    $_SESSION['tipo'] = "user";
                    //$_SESSION['img_google'] = $contenido_imagen = base64_encode(file_get_contents($_REQUEST['img']));
                    $_SESSION['img_google'] = $_REQUEST['img'];
                }
            }
    
    
        ?>
      
      </div>
      
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
