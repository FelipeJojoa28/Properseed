<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
//$mysqli = new mysqli($host, $user, $pw, $db);

   $cedula = $_POST["cedula"];
   $nombres = $_POST["nombre"];
   $tipo = $_POST["tipo"];
   $apellidos = $_POST["apellido"];
   $usuario = $_POST["usuario"];
   $contrasena1 = $_POST["contrasena"];   
   $contrasena = md5($contrasena1);  //La contraseña ya se cifra por lo tanto no va a funcionar el login hasta que se configure en la interfaz inicial
                                    //que se compare con el texto cifrado
         //Si algo no se coloca el parámetro "activo" del usuario porque ese se agrega automaticamente
   $mysqli = new mysqli($host, $user, $pw, $db);
   $sqlced = "SELECT * from Usuario WHERE Cedula=$cedula";
   $resultced = $mysqli->query($sqlced);
   $rowced = $resultced->fetch_array(MYSQLI_NUM);
   $numero_filasCed = $resultced->num_rows;
  
   if ($numero_filasCed > 0)
     { 
     
        echo "<div class=\"Mensaje\" style=\"color:red; padding-bottom: 15px; font-size: 0.9rem;\">
        	        <span>La cédula ingresada ya existe.</span>                         
        	  </div>";
     }
   else{
   $sqlcon = "SELECT * from Usuario WHERE Usuario='$usuario'";
   $resultcon = $mysqli->query($sqlcon);
   $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
   $numero_filas = $resultcon->num_rows;
     
   if ($numero_filas > 0)
     { 
     
        echo "<div class=\"Mensaje\" style=\"color:red; padding-bottom: 15px; font-size: 0.9rem;\">
        	        <span>El nombre de usuario ingresado ya existe.</span>                         
              </div>";
     }
   else
    {
      $sql = "INSERT INTO Usuario(Tipo, Apellidos, Nombres, Cedula, Usuario, Contraseña) 
      VALUES ('$tipo','$apellidos','$nombres','$cedula','$usuario','$contrasena')";
      //echo "sql es...".$sql; //sirve para observar que es lo que se esta enviando
      $result1 = $mysqli->query($sql);
      
      if ($result1 == 1) 
        {
          echo "<div class=\"Mensaje\" style=\"color:blue; padding-bottom: 15px; font-size: 0.9rem;\">
                        <span>Registro Exitoso.</span>                         
				</div>";
	        $cedula = "";
            $nombres = "";
            $tipo = "";
            $apellidos = "";
            $usuario = "";
            $contrasena1 = "";  
        }
      else
        echo "<div class=\"Mensaje\" style=\"color:red; padding-bottom: 15px; font-size: 0.9rem;\">
						<span>Error al registrar usuario, intente más tarde.</span>                         
		      </div>";
      
    }
   }
              
?>