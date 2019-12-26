<?php 
    session_start();
    if($_REQUEST['cod']!=$_SESSION['codigo']){
        header("Location: ../html/ErrorSinPermisos.html");
    }
?>
<html>
    <head><?php include '../html/Head.html';?></head>
    <body>
        <?php include 'Menus.php'?>
        <section class="main" id="s1">
            <form method="POST" action="NewPassForm.php">
                <h4>Direccion de Correo Electronico:</h4>
                <input type="email" size="30" name="email_req" id="email" value=<?php echo $_REQUEST['email'];?> readonly required/><br>
                <h4>Nueva Contraseña:*</h4>
                <input type="password" size="30" name="pass1" id="pass1" required/><br>
                <h4>Repite la Contraseña:*</h4>
                <input type="password" size="30" name="pass2" id="pass2" required/><br>
                <input type="submit" id="submit" value="Enviar"/>
            </form>

            <?php
                if(isset($_REQUEST['pass1'])){
                    include 'DbConfig.php';
                    $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
                    if(!$mysqli){
                        die("Fallo al conectar con Mysql: ".mysqli_connect_error());
                    }

                    $sql = "UPDATE FROM usuarios SET pass='".$_REQUEST['pass1']."' WHERE email='".$_REQUEST['email_req']."';";
                    $resul = mysqli_query($mysqli,$sql);
                    if(!$resul){
                        die("Error al intentar cambiar la contraseña.");
                    }else{
                        echo "<h3 style=\"color: green\">La tarea se ha realizado correctamente.</h3>";
                        echo "<h4> Ya puede iniciar sesion a traves del siguiente <a href=\"LogIn.php\">enlace.</a></h4>";
                    }
                }
            
            ?>
        </section>
    </body>
</html>