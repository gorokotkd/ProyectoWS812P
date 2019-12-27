<?php session_start();?>
<html>
    <head><?php include '../html/Head.html';?></head>
    <body>
        <?php include 'Menus.php'?>
        <section class="main" id="s1">
            <form method="POST" action="RestorePass.php">
                <h4>Introduce tu direccion de correo electronico:*</h4>
                <label>Si es correcta se te enviará un email para restablecer la contraseña.</label><br>
                <input type="email" size="30" name="email" id="email" required/><br>
                <input type="submit" id="submit" value="Enviar"/>
            </form>
            <?php
            if(isset($_REQUEST['email'])){
                include 'DbConfig.php';
                $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
                if(!$mysqli){
                    die("Fallo al conectar con Mysql: ".mysqli_connect_error());
                }
                //Comprobamos si el email introducido se encuentra en la BD
                $email = $_REQUEST['email'];
                
                $sql = "SELECT * FROM usuarios WHERE email='$email';";
                
                $resultado = mysqli_query($mysqli,$sql);
                if(mysqli_num_rows($resultado)!=1){
                    die();
                }
                $cod = generateRandomString();
                $_SESSION['codigo'] = $cod;
                $_SESSION['email_rec'] = $_REQUEST['email'];

                $msg = "<html><head><title>Recuperacion de Contraseña.</title></head><body><p>Hemos detectado una solicitud de restablecimiento de contraseña, si es correcta haz click en el siguiente <a href=\"https://sw19-20.000webhostapp.com/ProyectoWS19G18/php/NewPassForm.php?cod={$cod}&email={$email}\">enlace.</a></p><p>Si no es correcto pongase en contacto con el <a href=\"mailto:galvarez024@ikasle.ehu.eus\">administrador.</a></p></body></html>";

                $cabeceras = "MIME-Version: 1.0" . "\r\n";
                $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                $tema = "Recuperacion Contraseña Quiz.";
                mail($email,$tema,$msg,$cabeceras);
                echo "<h3 style=\"color: green\">Email enviado correctamente.</h3>";
                echo "Puede que reciba el mensaje en la carpeta Spam.";
            }
        ?>
        </section>
       
        <?php
            function generateRandomString($length = 16) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
        ?>
    </body>
</html>