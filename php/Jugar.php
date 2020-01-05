<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include '../html/Head.html'?>
    <script src="../js/TemaSeleccionado.js"></script>
</head>
<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div>
            <h2>Quiz: el juego de las preguntas</h2>
        </div>
        <div id="error"></div>
        <div>
        <form>
            <h4>Introduce tu nickname para jugar (Opcional):</h4>
            <input type="text" size="30" id="nickname" value="" maxlength="20">
            <h5>Elige uno de los siguientes temas:</h5>
            <?php
                include 'DbConfig.php';
                    
                $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
                if(!$mysqli){
                    die("Fallo al conectar con Mysql: ".mysqli_connect_error());
                }
                
                $sql = "SELECT tema FROM preguntas;";
                
                $resultado = mysqli_query($mysqli,$sql);
                if(!$resultado){
                    die("Error: ".mysqli_error($mysqli));
                }
                echo "<select name=\"temas\" id=\"temas\">
                        <option value=\"ninguno\"> / Elige Tema / </option>";
                $list = array();
                while($row = mysqli_fetch_array($resultado)){
                    if(!in_array($row['tema'],$list)){
                        echo "<option value=\"".$row['tema']."\">{$row['tema']}</option>";
                        $list[] = $row['tema'];
                    }
                }
                echo"</select>";
                mysqli_close($mysqli);
            ?>
        </form>
        </div>
        <div>
            <img id="jugar" src="../images/jugar.png" height="30%" width="30%" onclick="temaSeleccionado()">
        </div>

    </section>
    <?php include '../html/Footer.html' ?>
</body>
</html>
