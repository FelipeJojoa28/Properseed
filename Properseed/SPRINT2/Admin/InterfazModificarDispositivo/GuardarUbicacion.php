<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$lon = $_GET["longitud"]; 
$lat = $_GET["latitud"]; 
$ID_TARJ = $_GET["ID_TARJ"];

$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.

$sql1 = "UPDATE Dispositivo set Latitud='$lat' where Id='$ID_TARJ'";
$resultsql1 = $mysqli->query($sql1);
$sql2 = "UPDATE Dispositivo set Longitud='$lon' where Id='$ID_TARJ'";
$resultsql2 = $mysqli->query($sql2);
?>