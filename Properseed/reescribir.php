<?php
    include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
    //UPDATE `Alerta` SET `Tipo` = 'Baja' WHERE `Alerta`.`Id` = 129;
    //UPDATE `Alerta` SET `Tipo` = NULL, `Maximo` = '2' WHERE `Alerta`.`Id` = 129;
    $sql = "SELECT * FROM Alerta ORDER BY Id Desc";
    $result = $mysqli->query($sql);
    
    while ($row = $result->fetch_array(MYSQLI_NUM)){
     if ($row[2] == NULL){
         $id_disp = $row[9];
         $sql1 = "SELECT Id_rango FROM Dispositivo WHERE Id = $id_disp";
         $result1 = $mysqli->query($sql1);
         $row1= $result1->fetch_array(MYSQLI_NUM);
         $id_rang = $row1[0];
         
         $nombre = $row[1];
         
         if($nombre == "Temperatura")
            $tipo = "Temperatura";
         else if ($nombre == "Humedad del suelo")
            $tipo = "Humedad";
         else if ($nombre == "Humedad del ambiente")
            $tipo = "Humedad_ambiente";
         else
            $tipo = "Intensidad_luz";
         
         $sql1 = "SELECT ";
         $sql1 .= $tipo;
         $sql1 .= "_max, ";
         $sql1 .= $tipo;
         $sql1 .= "_min ";
         $sql1 .= "FROM Rango_parametros WHERE id = $id_rang";
         $result1 = $mysqli->query($sql1);
         $row1= $result1->fetch_array(MYSQLI_NUM);
         $tipo1 = "Normal";
         if($row[3] > $row1[0])
             $tipo1 = "Alta";
         else if($row[3] < $row1[1])
             $tipo1 = "Baja";
             
         $max = $row1[0];
         $min = $row1[1];
         $id = $row[0];
         $sql1 = "UPDATE Alerta SET Tipo = '$tipo1', Maximo = '$max', Minimo = '$min' WHERE Id = '$id'";
         echo $sql1;
         $result1 = $mysqli->query($sql1);
         
     }
    }
                
?>