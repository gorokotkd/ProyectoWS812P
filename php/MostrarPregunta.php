<?php
    if(isset($_REQUEST['id'])){
        include 'DbConfig.php';

        $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
        if(!$mysqli){
            die("Fallo al conectar con Mysql: ".mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM preguntas WHERE clave='{$_REQUEST['id']}';";
        
        $resultado = mysqli_query($mysqli,$sql);
        if(!$resultado){
            die("Error: ".mysqli_error($mysqli));
        }

        $row = mysqli_fetch_array($resultado);
        echo "<table style=\"margin-left: auto; margin-right: auto\">";
        if($row['imagen'] != ""){
            echo "  <tr>
                    <th colspan='2'>{$row['enunciado']}</th>
                    <th colspan='2'><img width=\"150\" height=\"150\" src=\"data:image/*;base64, ".$row['imagen']."\" alt=\"Imagen\"/></th>            
                </tr>";
        }else{
            echo "<tr>
                    <th colspan='2'>{$row['enunciado']}</th>
                    <th colspan='2'><img width=\"150\" height=\"150\" src=\"../images/Imagen_no_disponible.png\" alt=\"Imagen\"/></th>            
                </tr>";
        }

        if($row['complejidad']==1){
            echo "<tr>
                    <th colspan='2'>Nivel de dificultad:</th>
                    <th colspan='2'>Bajo</th>         
                </tr>";
        }elseif($row['complejidad'==2]){
            echo "<tr>
                    <th colspan='2'>Nivel de dificultad:</th>
                    <th colspan='2'>Medio</th>         
                </tr>";
        }else{
            echo "<tr>
                    <th colspan='2'>Nivel de dificultad:</th>
                    <th colspan='2'>Alto</th>         
                </tr>";
        }

        echo"<tr>
                <td colspan='4'>Elige una respuesta, solo una es valida</td>
            </tr>";

        //Genero un numero aleatorio entre 1 y 4 para colocar la respuesta correcta.
        $pos = rand(1,4);

        if($pos==1){
            echo"<tr>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestac']}\">{$row['respuestac']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai2']}\">{$row['respuestai2']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai1']}\">{$row['respuestai1']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai3']}\">{$row['respuestai3']}</td>
                </tr>";
        }elseif($pos==2){
            echo"<tr>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai1']}\">{$row['respuestai1']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestac']}\">{$row['respuestac']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai2']}\">{$row['respuestai2']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai3']}\">{$row['respuestai3']}</td>
                </tr>";
        }elseif($pos==3){
            echo"<tr>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai3']}\">{$row['respuestai3']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai2']}\">{$row['respuestai2']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestac']}\">{$row['respuestac']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai1']}\">{$row['respuestai1']}</td>
                </tr>";
        }else{
            echo"<tr>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai3']}\">{$row['respuestai3']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai1']}\">{$row['respuestai1']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestai2']}\">{$row['respuestai2']}</td>
                    <td><input type=\"radio\" name=\"respuesta\" value=\"{$row['respuestac']}\">{$row['respuestac']}</td>
                </tr>";
        }
        echo "</table>";
        
    }else{
        echo "<h3 style='color: red'>Necesaria la id de la pregunta</h3>";
    }
?>