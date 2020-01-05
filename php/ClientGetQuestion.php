<?php include'../php/Seguridad.php'?>
<?php
    if($_SESSION['tipo']=="admin"){
        header('location:Layout.php');
    }
?>
<html>
    <head>
        <?php include'../html/Head.html';?>
    </head>
    <body>
         <?php include '../php/Menus.php' ?>
        <section class="main" id="s1">
            <div>
                <form id="fquestion-id" method="post">
                    <label>Introduce la id de la pregunta de la que se desea conocer la informacion:</label><br>
                    <input type="text" name="id" size="30"><br>
                    <input type="submit" value="Ver Pregunta" id="submit">
                    <div id="div-result"></div>       
                </form>
                <?php
                    if(isset($_REQUEST['id'])){
                        require_once('../lib/nusoap.php');
                        require_once('../lib/class.wsdlcache.php');

                        $ticket = "1010";

                        $soapclient = new nusoap_client('https://'.$_SERVER['HTTP_HOST'].'/ProyectoWS19G18/lib/GetQuestionWS.php?wsdl',true);

                        $err = $soapclient->getError();
                        if($err){   echo 'Error al crear el cliente: '.$err;    }
                        $id = strip_tags($_REQUEST['id']);
                        $param = array('id' => $id, 'ticket' => $ticket);

                        $resul = $soapclient->call('obtenerPregunta',$param);

                       /* echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
                        echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
                        echo '<h2>Debug</h2>';
                        echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';*/

                        if($resul['clave']==-1){
                            echo "<h3 style='color: red'>No existe la pregunta con id: {$id}</h3>";
                        }else{
                            echo "<section class=main>";
                            echo "<table border = 1 ><tr bgcolor = \"#9acd32\"><th>Identificador</th><th>Autor</th><th>Enunciado</th><th>Respuesta Correcta</th></tr>";
                            echo "<tr><td>".$resul['clave']."</td><td>".$resul['email']."</td><td>".$resul['enunciado']."</td><td>".$resul['respuestac']."</td></tr>";
                            echo "</table>";
                            echo "</section>";
                        }
                    }

                ?>
            </div> 
        </section>
    </body>




</html>