<?php include 'Seguridad.php'?>
<?php
    if($_SESSION['tipo']=="admin"){
        header('location:Layout.php');
    }
?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
  <section class="main" id="s1">
    <div>
         <?php
            if(isset($_REQUEST['dirCorreo'])){

              //Compruebo el formato del archivo
              if($_FILES['Imagen']['name'] != ""){
                $allowed = array('gif', 'png', 'jpg');
                $filename = $_FILES['Imagen']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    die("Error formato de imagen no soportado.");
                }
              }
              

              //  $regexMail="/((^[a-zA-Z]+(([0-9]{3})+@ikasle\.ehu\.(eus|es))$)|^[a-zA-Z]+(\.[a-zA-Z]+@ehu\.(eus|es)|@ehu\.(eus|es))$)/";
                $regexPreg="/^.{10,}$/";
                if(preg_match($regexPreg,$_REQUEST['nombrePregunta'])){
                  include 'DbConfig.php';
                  //Creamos la conexion con la BD.
                  $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
                  if(!$mysqli)
                  {
                      die("Fallo al conectar a MySQL: " .mysqli_connect_error());
                  }
                  //Creamos la consulta que introducira los datos en el servidor
                  $email = strip_tags($_REQUEST['dirCorreo']);
                  $enunciado = strip_tags($_REQUEST['nombrePregunta']);
                  $respuestac = strip_tags($_REQUEST['respuestaCorrecta']);
                  $respuestai1 = strip_tags($_REQUEST['respuestaIncorrecta1']);
                  $respuestai2 = strip_tags($_REQUEST['respuestaIncorrecta2']);
                  $respuestai3 = strip_tags($_REQUEST['respuestaIncorrecta3']);
                  $complejidad = strip_tags($_REQUEST['complejidad']);
                  $tema = ($_REQUEST['temaPregunta']);

                  if($_FILES['Imagen']['name'] == ""){
                      $contenido_imagen = base64_encode("");
                      //añado una imagen vacia.
                  }else{
                      $image = $_FILES['Imagen']['tmp_name'];
                      $contenido_imagen = base64_encode(file_get_contents($image));
                  }
                  
                  $sql = "INSERT INTO preguntas(email, enunciado, respuestac, respuestai1, respuestai2, respuestai3, complejidad, tema, imagen) VALUES('$email', '$enunciado', '$respuestac', '$respuestai1', '$respuestai2', '$respuestai3', $complejidad, '$tema', '$contenido_imagen')";


                  if(!mysqli_query($mysqli,$sql))
                  {
                      die("Error: " .mysqli_error($mysqli));
                  }
                  echo "Registro añadido en la base de datos.<br>";
                  mysqli_close($mysqli);
                  anadirAXML();
                }else{
                    echo "El enunciado de la pregunta debe tener mas de 10 caracteres.<br>";

                }
            }          
          ?>
    </div>
      
      <div>
        <?php
          function anadirAXML(){
            if(file_exists('../xml/Questions.xml')){
              $ficheroPreguntas = simplexml_load_file('../xml/Questions.xml');
              
              $assessmentItem = $ficheroPreguntas->addChild('assessmentItem');
              $assessmentItem->addAttribute('subject',strip_tags($_REQUEST['temaPregunta']));
              $assessmentItem->addAttribute('author',strip_tags($_REQUEST['dirCorreo']));
              
              $itemBody = $assessmentItem->addChild('itemBody');
                  
              $itemBody->addChild('p',strip_tags($_REQUEST['nombrePregunta']));
              
              $correctResponse = $assessmentItem->addChild('correctResponse');
              $correctResponse->addChild('value',strip_tags($_REQUEST['respuestaCorrecta']));
              
              $incorrectResponses = $assessmentItem->addChild('incorrectResponses');
              
              $incorrectResponses->addChild('value',strip_tags($_REQUEST['respuestaIncorrecta1']));
              $incorrectResponses->addChild('value',strip_tags($_REQUEST['respuestaIncorrecta2']));
              $incorrectResponses->addChild('value',strip_tags($_REQUEST['respuestaIncorrecta3']));
            
              $ficheroPreguntas->asXML('../xml/Questions.xml') or die("Error al guardar el fichero Questions.xml");
              echo "Registro añadido en XML.<br>";
            }else{
                  exit("No se ha podido guardar en XML, no se encuentra el fichero Questions.xml");
            }
          }
          ?>
      </div>
  </section>
</body>

</html>