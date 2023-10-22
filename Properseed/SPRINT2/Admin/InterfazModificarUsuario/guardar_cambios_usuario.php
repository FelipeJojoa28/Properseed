<?php
ob_start();
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db);
if ((isset($_POST["enviado"])))
  {
   $id_usu_enc = $_POST["ID_USU"]; //encriptado, Revisar para la bd a usar
   $tipo_usuario = $_POST["tipo"];
   $Usuario  = $_POST["usuario"];
   $Apellido = $_POST["apellido"];                 
   $nombre_usuario = $_POST["nombre"];
   $cedula = $_POST["cedula"];
   $password = $_POST["contrasena"];
   $Activo = $_POST["activo"];
   
   $sqlcon = "SELECT * from Usuario WHERE Usuario='$Usuario' AND Id!='$id_usu_enc'";
   $resultcon = $mysqli->query($sqlcon);
   $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
   $numero_filas = $resultcon->num_rows;
     
   if ($numero_filas > 0)
     { 
     
         header("Location: InterfazModificarUsuario.php?mensaje=5&ID_USU=$id_usu_enc"); //Aqui va el mensaje si ya esta registrado ese usuario (nickname)
     }
   
   else{
   $sqlced = "SELECT * from Usuario WHERE Cedula=$cedula AND Id!='$id_usu_enc'";
   $resultced = $mysqli->query($sqlced);
   $rowced = $resultced->fetch_array(MYSQLI_NUM);
   $numero_filasCed = $resultced->num_rows;
  
   if ($numero_filasCed > 0)
     { 
         header("Location: InterfazModificarUsuario.php?mensaje=6&ID_USU=$id_usu_enc");  //Aqui va el mensaje si ya esta registrada la cedula
     }
     else{
   // ACTUALIZACIONES 
   $mysqli = new mysqli($host, $user, $pw, $db);
   $sqlu1 = "UPDATE Usuario set Tipo='$tipo_usuario' where Id='$id_usu_enc'"; 
   $resultsqlu1 = $mysqli->query($sqlu1);
   $sqlu2 = "UPDATE Usuario set Usuario='$Usuario' where Id='$id_usu_enc'"; 
   $resultsqlu2 = $mysqli->query($sqlu2);
   $sqlu3 = "UPDATE Usuario set Apellidos='$Apellido' where Id='$id_usu_enc'"; 
   $resultsqlu3 = $mysqli->query($sqlu3);
   $sqlu4 = "UPDATE Usuario set Nombres='$nombre_usuario' where Id='$id_usu_enc'"; 
   $resultsqlu4 = $mysqli->query($sqlu4);
   $sqlu5 = "UPDATE Usuario set Cedula='$cedula' where Id='$id_usu_enc'"; 
   $resultsqlu5 = $mysqli->query($sqlu5);
   $sqlu6 = "UPDATE Usuario set Activo='$Activo' where id='$id_usu_enc'"; 
   $resultsqlu6 = $mysqli->query($sqlu6);
   if ($password != "")
     {
     $password_enc = md5($password);
     $sqlu7 = "UPDATE Usuario set Contraseña='$password_enc' where id='$id_usu_enc'"; 
     $resultsqlu7 = $mysqli->query($sqlu7);
     }   
   if (($resultsqlu1 == 1) && ($resultsqlu2 == 1) && ($resultsqlu3 == 1) && ($resultsqlu4 == 1) && 
       ($resultsqlu5 == 1) && ($resultsqlu6 == 1))          
         header('Location: InterfazBuscarUsuario.php?mensaje=1');
   else
         header('Location: InterfazBuscarUsuario.php?mensaje=2');  
    }    
   }
  }
    ob_end_flush();
    // luego seguiria el formulario según el ejemplo del profesor, 
    // aunque no se si debe ir el else
    // según el modelo que estamos trabajando
?>