<?php
ob_start();

// PROGRAMA DE VALIDACION DE USUARIOS
$login = $_POST["login"];
$passwd = $_POST["passwd"];
$passwd = md5($passwd);

session_start();
include ("../conexion.php");
$mysqli = new mysqli($host, $user, $pw, $db);

$sql = "SELECT * from Usuario where Usuario = '$login'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$numero_filas = $result1->num_rows;
if ($row1[7] == 0)
    $numero_filas = 0;


if ($numero_filas > 0){

  $passwdc = $row1[6];
  if ($passwdc == $passwd) //$passwd_comp para codificada
    {
      $_SESSION["autenticado"]= "P5-4ut";
      $_SESSION["id"]= $row1[0];
      $_SESSION["tipo"]= $row1[1];
      $_SESSION["apellidos"]= $row1[2];
      $_SESSION["nombres"]= $row1[3];  
      $_SESSION["cedula"]= $row1[4];
      
      if ($row1[1] == 'Administrador')
          header("Location: /SPRINT2/Admin/InterfazGestionUsuarios/InterfazGestionUsuarios.php");
       else
          header("Location: /SPRINT2/Agricultor/InterfazRegistroEntreFechas/InterfazSeleccionarFecha.php");
    }else {
      header('Location: /SPRINT2/InterfazInicioSesion.php?mensaje=1');
    }
}else {
  header('Location: /SPRINT2/InterfazInicioSesion.php?mensaje=2');
}
ob_end_flush();
?>
