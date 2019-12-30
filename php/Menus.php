<script src="../js/cierreSesion.js"></script>
<script src="../js/inicioSesion.js"></script>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right" id="register"><a href="SignUp.php">Registro</a></span>
        <span class="right" id="login"><a href="LogIn.php">Login</a></span>
        <span class="right" id="login-google"><div style="margin-left: 46.9%"><div class="g-signin2" data-onsuccess="onSuccess"></div></div></span>
        <span class="right" id="logout" style="display:none;" onclick="signOut()"><a href="DecreaseGlobalCounter.php">Logout</a></span>

</header>
<nav class='main' id='n1' role='navigation'>
    <span><a href='Layout.php'>Inicio</a></span>
    <span id="users" style="display:none"><a href='HandlingAccounts.php'> Gestionar Usuarios</a></span>
    <span id="jugar"><a href='Jugar.php'>A jugar!</a></span>
    <span id="questions" style="display:none"><a href='HandlingQuizesAjax.php'> Gestionar Preguntas</a></span>
    <span id="id-question" style="display:none"><a href='ClientGetQuestion.php'> Obtener Datos Preguntas</a></span>
    <span><a href='Credits.php'>Creditos</a></span>
</nav>
    <script src="../js/jquery-3.4.1.min.js"></script>

        
        <!--    Script Para iniciar sesion con google.  -->
    <script>

        function signOut(){
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                console.log("Signed Out from Google.");
            });
            
        }
        function onSuccess(googleUser) {
            //gapi.auth2.init();
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

        function init() {
            gapi.load('auth2', function() {
            gapi.auth2.init();
            
            });
        }
    </script>
    <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>



<?php
    
    if(isset($_SESSION['email'])){
        //Comprobamos si el usuario es de google o de la pagina.
        //Si es un usuario de google le pasaremos true como parametro en el metodo inicioSesion().
        if(isset($_SESSION['img_google'])){
            $email = $_SESSION['email'];
            $img = $_SESSION['img_google'];
            echo "<script>inicioSesion('".addslashes($img)."','".addslashes($email)."','".addslashes($_SESSION['tipo'])."',true);</script>";
        }else{
            $email = $_SESSION['email'];
            $img = getImagenDeBD();
            echo "<script>inicioSesion('".addslashes($img)."','".addslashes($email)."','".addslashes($_SESSION['tipo'])."',false);</script>";
        }
        
        
        
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