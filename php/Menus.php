<script src="../js/cierreSesion.js"></script>
<script src="../js/inicioSesion.js"></script>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right" id="register"><a href="SignUp.php">Registro</a></span>
        <span class="right" id="login"><a href="LogIn.php">Login</a></span>
        <span class="right" id="logout" style="display:none;"><a href="DecreaseGlobalCounter.php">Logout</a></span>

</header>
<nav class='main' id='n1' role='navigation'>
    <span><a href='Layout.php'>Inicio</a></span>
    <span id="users" style="display:none"><a href='HandlingAccounts.php'> Gestionar Usuarios</a></span>
    <span id="questions" style="display:none"><a href='HandlingQuizesAjax.php'> Gestionar Preguntas</a></span>
    <span id="id-question" style="display:none"><a href='ClientGetQuestion.php'> Obtener Datos Preguntas</a></span>
    <span><a href='Credits.php'>Creditos</a></span>
</nav>
    <script src="../js/jquery-3.4.1.min.js"></script>

<?php
    
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $img = getImagenDeBD();
       // echo "<script>inicioSesion(\"".addslashes($img)."\",\"".$email."\",\"".$_SESSION['tipo']."\");</script>";
        echo "<script>inicioSesion('".addslashes($img)."','".addslashes($email)."','".addslashes($_SESSION['tipo'])."');</script>";
    }else{

        echo "<script>cierreSesion();</script>";
    }
    
    function getImagenDeBD(){
        include 'DbConfig.php';
        $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
        if(!$mysqli){
            die("Error: ".mysqli_connect_error);
        }

        $sql = "SELECT foto FROM usuarios WHERE email=\"".$_SESSION['email']."\";";
        $resul = mysqli_query($mysqli,$sql, MYSQLI_USE_RESULT);
        if(!$resul){
            die("Error: ".mysqli_error($mysqli));
        }
        $img = mysqli_fetch_array($resul);
        return $img['foto'];
}
    ?>