<?php session_start()?>

<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="../js/LocateUser.js"></script>
    
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>DATOS DEL AUTOR/AUTORES</h2><br>
        <p>Gorka Alvarez Marlasca</p>
        <p>Correo contacto: <a href="mailto:galvarez024@ikasle.ehu.eus" >galvarez024@ikasle.ehu.eus</a></p>
        <br>
        <img src="../images/FotoGorka.jpg" width="110" height="125">
        <p>Estudiante de Ingeniería Informática en la especialización <br> de Ingeniería del Software.</p>
        <br><hr>
        <p>Iñaki Garcia Noya</p>
        <p>Correo contacto: <a href="mailto:igarcia361@ikasle.ehu.eus" >igarcia361@ikasle.ehu.eus</a></p>
        <br>
        <img src="../images/avatarIaki.png.jpg" width="125" height="125">
        <p>Estudiante de Ingeniería Informática en la especialización <br> de Ingeniería del Software.</p>
        <hr>
    </div>
      <h2>Tu ubicación, sientete vigilado:</h2>
      <a href="http://www.geoplugin.com/geolocation/" target="_new">IP Geolocation</a> by <a href="http://www.geoplugin.com/" target="_new">geoPlugin</a>
    <div id="map_canvas" style="width:50%; height:100%; margin-right:auto; margin-left:auto"></div>
      <div id="location-info"></div>
      <div id="weather-info"></div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
