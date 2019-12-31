<!DOCTYPE html>
<html>

<head>
  <!-- <?php include '../html/Head.html'?> -->
</head>

<body>
  <!-- <?php include '../php/Menus.php' ?> -->
  <section class="main" id="s1">
    <div>
         <?php
            if(isset($_REQUEST['dirCorreo'])){
              //  $regexMail="/((^[a-zA-Z]+(([0-9]{3})+@ikasle\.ehu\.(eus|es))$)|^[a-zA-Z]+(\.[a-zA-Z]+@ehu\.(eus|es)|@ehu\.(eus|es))$)/";
                $regexPreg="/^.{10,}$/";
               //  if(preg_match($regexMail,$_REQUEST['dirCorreo'])){
                     if(preg_match($regexPreg,$_REQUEST['nombrePregunta'])){
                            include 'DbConfig.php';
                            //Creamos la conexion con la BD.
                            $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
                            if(!$mysqli)
                            {
                                die("Fallo al conectar a MySQL: " .mysqli_connect_error());
                            }
                            //Creamos la consulta que introducira los datos en el servidor
                            $email = $_REQUEST['dirCorreo'];
                            $enunciado = $_REQUEST['nombrePregunta'];
                            $respuestac = $_REQUEST['respuestaCorrecta'];
                            $respuestai1 = $_REQUEST['respuestaIncorrecta1'];
                            $respuestai2 = $_REQUEST['respuestaIncorrecta2'];
                            $respuestai3 = $_REQUEST['respuestaIncorrecta3'];
                            $complejidad = $_REQUEST['complejidad'];
                            $tema = $_REQUEST['temaPregunta'];
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
                            //echo "<a href=\"ShowQuestionsWithImage.php?email=".$_GET['email']."\">Click en este enlace para ver todos los registros.</a>";
                            mysqli_close($mysqli);
                            anadirAXML();
                     }else{
                         echo "El enunciado de la pregunta debe tener mas de 10 caracteres.<br>";
                         /* echo"<a href='javascript:history.back()'>Volver al formulario.</a>"; */
                     }
              /*   }else{
                    echo "El correo electronico no es correcto.<br>";
                     echo"<a href='javascript:history.back()'>Volver al formulario.</a>"; 
                 }*/
            }          
          ?>
    </div>
      
      <div>
        <?php
          function anadirAXML(){
            if(file_exists('../xml/Questions.xml')){
              $ficheroPreguntas = simplexml_load_file('../xml/Questions.xml');
              
              $assessmentItem = $ficheroPreguntas->addChild('assessmentItem');
              $assessmentItem->addAttribute('subject',$_REQUEST['temaPregunta']);
              $assessmentItem->addAttribute('author',$_REQUEST['dirCorreo']);
              
              $itemBody = $assessmentItem->addChild('itemBody');
                  
              $itemBody->addChild('p',$_REQUEST['nombrePregunta']);
              
              $correctResponse = $assessmentItem->addChild('correctResponse');
              $correctResponse->addChild('value',$_REQUEST['respuestaCorrecta']);
              
              $incorrectResponses = $assessmentItem->addChild('incorrectResponses');
              
              $incorrectResponses->addChild('value',$_REQUEST['respuestaIncorrecta1']);
              $incorrectResponses->addChild('value',$_REQUEST['respuestaIncorrecta2']);
              $incorrectResponses->addChild('value',$_REQUEST['respuestaIncorrecta3']);
            
              $ficheroPreguntas->asXML('../xml/Questions.xml');
              echo "Registro añadido en XML.<br>";
            }else{
                  exit("No se ha podido guardar en XML, no se encuentra el fichero Questions.xml");
            }
          }
          ?>
      </div>
  </section>
  <!-- <?php include '../html/Footer.html' ?> -->
</body>

</html>