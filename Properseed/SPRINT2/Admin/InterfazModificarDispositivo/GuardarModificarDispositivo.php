<?php
ob_start();
include "conexion.php";
$mysqli = new mysqli($host, $user, $pw, $db);
if ((isset($_POST["enviado"]))){

	$id_dis = $_POST["id_dis"]; //encriptado, Revisar para la bd a usar
	$estado = $_POST["Estado"];
	$id_rango = $_POST["id_rango"];
	$nombre  = $_POST["Nombre"];
    $temp_max = $_POST["Temp_max"];  
    $temp_min = $_POST["Temp_min"];                   
    $hum_max = $_POST["Hum_max"];
    $hum_min = $_POST["Hum_min"];
    $luz_max = $_POST["Luz_max"];
    $luz_min = $_POST["Luz_min"];
    $humAmb_max = $_POST["HumAmb_max"];
    $humAmb_min = $_POST["HumAmb_min"];
	$coordenada = $_POST["Coordenada"];                 

   // ACTUALIZACIONES 
	$sqlu1 = "UPDATE Dispositivo set Estado='$estado' where id='$id_dis'";
	$resultsqlu1 = $mysqli->query($sqlu1);
	$sqlu2 = "UPDATE Dispositivo set Nombre='$nombre' where id='$id_dis'"; 
	$resultsqlu2 = $mysqli->query($sqlu2);
    $sqlu3 = "UPDATE  Rango_parametros set Temperatura_max='$temp_max' where Id='$id_rango'"; 
	$resultsqlu3 = $mysqli->query($sqlu3);
    $sqlu4 = "UPDATE  Rango_parametros set Temperatura_min='$temp_min' where Id='$id_rango'"; 
	$resultsqlu4 = $mysqli->query($sqlu4);
    $sqlu5 = "UPDATE  Rango_parametros set Humedad_max='$hum_max' where Id='$id_rango'"; 
	$resultsqlu5 = $mysqli->query($sqlu5);
    $sqlu6 = "UPDATE  Rango_parametros set Humedad_min='$hum_min' where Id='$id_rango'"; 
	$resultsqlu6 = $mysqli->query($sqlu6);
    $sqlu7 = "UPDATE  Rango_parametros set Intensidad_luz_max='$luz_max' where Id='$id_rango'"; 
	$resultsqlu7 = $mysqli->query($sqlu7);
    $sqlu8 = "UPDATE  Rango_parametros set Intensidad_luz_min='$luz_min' where Id='$id_rango'"; 
	$resultsqlu8 = $mysqli->query($sqlu8);
    $sqlu9 = "UPDATE  Rango_parametros set Humedad_ambiente_max='$humAmb_max' where Id='$id_rango'"; 
	$resultsqlu9 = $mysqli->query($sqlu9);
    $sqlu10 = "UPDATE  Rango_parametros set Humedad_ambiente_min='$humAmb_min' where Id='$id_rango'"; 
	$resultsqlu10 = $mysqli->query($sqlu10);
	

 	$ubicacion_coma= strpos($coordenada,","); // Ubica la posición del caracter coma en la variable.
	$ubicacion_coma2 = $ubicacion_coma +1;
	$largo_cad = strlen($coordenada); // determina el largo de toda la cadena.
	$largo_lat = $largo_cad - $ubicacion_coma; 
	$latitud = substr($coordenada,0,$ubicacion_coma); // asigna la subcadena de coordenada que le corresponde a la latitud.
	$longitud = substr($coordenada,$ubicacion_coma2,$largo_lat); // asigna la subcadena de coordenada que le corresponde a la longitud

	
	$sqlu3 = "UPDATE Dispositivo set Latitud='$latitud' where id='$id_dis'"; 
	$resultsqlu3 = $mysqli->query($sqlu3);
	$sqlu4 = "UPDATE Dispositivo set Longitud='$longitud' where id='$id_dis'";
	$resultsqlu4 = $mysqli->query($sqlu4);

	if (($resultsqlu1 == 1) && ($resultsqlu2 == 1) && ($resultsqlu3 == 1) && ($resultsqlu4 == 1) && ($resultsqlu5 == 1) && ($resultsqlu6 == 1) && ($resultsqlu7 == 1) && ($resultsqlu8 == 1) && ($resultsqlu9 == 1) && ($resultsqlu10 == 1)){
		header('Location: InterfazSeleccionarUsuario.php?mensaje=1');
	}else{        
		header('Location: gestion_usuarios.php?mensaje=2');
	}
}
ob_end_flush();
?>