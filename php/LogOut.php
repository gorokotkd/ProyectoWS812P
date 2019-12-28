<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <meta name="google-signin-client_id" content="482385241484-3t98l5bcobkq6mifve3dv5kcgr9gei7n.apps.googleusercontent.com">
  <?php include '../html/Head.html'?>
</head>
<body onload="logout()">
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
      <script>
        

      </script>

      
    <?php 
      if(isset($_SESSION['img_google'])){
        echo "<script>
        function init() {
          console.log('Entro Aqui');
          gapi.load('auth2', function() {
            gapi.auth2.init();
          });
        }
        function logout(){
          var auth2 = gapi.auth2.getAuthInstance();
          auth2.signOut().then(function () {
            console.log('User signed out.');
          });
          
        }
          
      </script>";
      }else{
        session_destroy();
        echo "<script>
        function logout(){
              alert('Adios, vuelve cuando quieras.');
              window.location.href='Layout.php';
        }
            </script>";
      }
        
    ?>

    <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
      
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
