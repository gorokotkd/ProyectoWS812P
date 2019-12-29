<?php
    include 'Seguridad.php';
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

        <h2>Quiz: el juego de las preguntas</h2>
        <h4>Tema Seleccionado: <?php echo $_REQUEST['tema'];?></h4>
    </div>

  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
