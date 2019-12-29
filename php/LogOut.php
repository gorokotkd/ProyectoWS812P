<?php session_start();session_destroy();?>
<!DOCTYPE html>
<html>
<head>
  <meta name="google-signin-client_id" content="482385241484-3t98l5bcobkq6mifve3dv5kcgr9gei7n.apps.googleusercontent.com">
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
        
      <script>
        alert('Adios, vuelve cuando quieras.');
        window.location.href='Layout.php';
      </script>
        
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
