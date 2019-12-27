<?php 
    session_start();
    if($_REQUEST['cod']!=$_SESSION['codigo']){
        header("Location: ../html/ErrorSinPermisos.html");
    }
?>
<html>
    <head>
        <?php include '../html/Head.html';?>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/CheckPassRestore.js"></script>
        
    </head>
    <body>
        <?php include 'Menus.php'?>
        <section class="main" id="s1">
        <form id="form">
            <h4>Direccion de Correo Electronico:</h4>
            <input type="email" size="30" name="email" id="email" value=<?php echo $_REQUEST['email'];?> readonly required/><br>
            <h4>Nueva Contraseña:*</h4>
            <input type="password" size="30" name="pass" id="pass" required/><br>
            <div id="pass-div"></div>
            <h4>Repite la Contraseña:*</h4>
            <input type="password" size="30" name="pass2" id="pass2" required/><br>
            <div id="pass2-div"></div>
            <button id="enviar" disabled>Enviar</button>
            <div id="resul"></div>
            </form>
        </section>
    </body>
</html>