<?php
    include 'DbConfig.php';

    $mysqli = mysqli_connect($server,$user,$pass,$basededatos);
    if(!$mysqli){
        die("Fallo al conectar con Mysql: ".mysqli_connect_error());
    }
    
   // $sql = "SELECT * FROM juego WHERE nickname='{$_REQUEST['nickname']}';";
    $sql = "SELECT * FROM juego ORDER BY aciertos DESC;";
    
    $resultado = mysqli_query($mysqli,$sql);
    if(!$resultado){
      die("Error: ".mysqli_error($mysqli));
    }
    $i = 0;

    echo '<table border=1 style="margin-left:auto; margin-right:auto" class=tabla_style>
            <tr>
                <th>Puesto</th>
                <th>Nickname</th>
                <th>Tema</th>
                <th>Aciertos</th>
                <th>Fallos</th>
                <th>Fecha</th>
            </tr>';
    
    while(($row = mysqli_fetch_array($resultado))&&($i<9)){
        echo '
            <tr>
                <th>#'.($i+1).'</th>
                <td>'.$row["nickname"].'</td>
                <td>'.$row["tema"].'</td>
                <td>'.$row["aciertos"].'</td>
                <td>'.$row["fallos"].'</td>
                <td>'.$row["fecha"].'</td>
            </tr>';
            $i += 1;
    }

    echo '</table>';
?>