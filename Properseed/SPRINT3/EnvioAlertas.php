<?php
    
    include "conexion.php";                                                 
    $mysqli = new mysqli($host, $user, $pw, $db);
    $id_disp = $_GET["id"];  
    $sql = "SELECT Id_Rango FROM Dispositivo WHERE Id = $id_disp";
    $result1 = $mysqli->query($sql);
    $row1 = $result1->fetch_array(MYSQLI_NUM);
    
    $sql = "SELECT * FROM Rango_parametros WHERE Id = $row1[0]";
    $result1 = $mysqli->query($sql);
    $row1 = $result1->fetch_array(MYSQLI_NUM);
    
    echo "#".$row1[1]."a".$row1[2]."b".$row1[3]."c".$row1[4]."d".$row1[5]."e".$row1[6]."f".$row1[7]."g".$row1[8];
?>