<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/rankingQuizers.js"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>Quiz: el juego de las preguntas</h2>
      <h4>Nuestro Top 10 Quizers!</h4>
        <!--<img src="../images/quiz.jpg" width="40%" height="40%">-->
      <div id="tabla-quizers"></div>
    </div>

  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
