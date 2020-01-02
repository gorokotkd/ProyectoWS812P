<?php
    if(isset($_REQUEST['nickname'])&&isset($_REQUEST['aciertos'])&&isset($_REQUEST['errores'])){
        include 'DbConfig.php';
        //Creamos la conexion con la BD.
        $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
        if(!$mysqli)
        {
            die("Fallo al conectar a MySQL: " .mysqli_connect_error());
        }

        //Tendre un # al final si he dado like o dislike a una pregunta
        if($string[strlen($_REQUEST['nickname'])-1] == "#"){
            $nickname_aux = substr($_REQUEST['nickname'], 0, -1); 
        }else{
            $nickname_aux = $_REQUEST['nickname'];
        }
        

        if($nickname_aux != ""){
            $nickname = $nickname_aux;
        }else{
            $nickname = "anonimo";
        }
        $tema = $_REQUEST['tema'];
        $aciertos = $_REQUEST['aciertos'];
        $errores = $_REQUEST['errores'];
        $hoy = date("d-m-Y");
		//Creamos la consulta que introducira los datos en el servidor
    
        $sql = "INSERT INTO juego(nickname, tema, aciertos, fallos, fecha) VALUES('$nickname', '$tema', '$aciertos', '$errores','$hoy')";
    
        if(!mysqli_query($mysqli,$sql))
        {
            die("Error: " .mysqli_error($mysqli));
        }
        echo "Registro añadido";
        
        mysqli_close($mysqli);
    }
?>