<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/Jugar.js"></script>
</head>
<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
      <div>
        <h2>Quiz: el juego de las preguntas</h2>
        <h4>Tema Seleccionado: <span id="tema"><?php echo $_REQUEST['tema'];?></span></h4>
        <input type="text" hidden id="claves-preguntas" value=<?php echo clavesPreguntas();?>>
      </div>
      <div id="juego">
      <div>

      <?php
        function clavesPreguntas(){
            include 'DbConfig.php';

            $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
            if(!$mysqli){
                die("Fallo al conectar con Mysql: ".mysqli_connect_error());
            }
            
            $sql = "SELECT clave FROM preguntas WHERE tema='{$_REQUEST['tema']}';";
            
            $resultado = mysqli_query($mysqli,$sql);
            if(!$resultado){
                die("Error: ".mysqli_error($mysqli));
            }
            $str ="";
            while($row = mysqli_fetch_array($resultado)){
              $str = $str."&".$row['clave'];
            }

            return $str;
        }
      ?>

  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
