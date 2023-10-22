<?php
include ("conexion.php");

  $id_usuario = $_POST["Id_usuario"];
  $nombre = $_POST["nombre_disp"];
  $temp_max = $_POST["Temp_max"];
  $temp_min = $_POST["Temp_min"];
  $hum_max = $_POST["Hum_max"];
  $hum_min = $_POST["Hum_min"];
  $luz_max = $_POST["Luz_max"];
  $luz_min = $_POST["Luz_min"];
  $humAmb_max = $_POST["HumAmb_max"];
  $humAmb_min = $_POST["HumAmb_min"];
  
  
  $coordenada = $_POST["coordena"];
  //list($latitud_str, $longitud_str) = explode(",", $coordenadas);
  //$longitud = substr($longitud_str, 0, 7);
  //$latitud = substr($latitud_str, 0, 8);
  
  $ubicacion_coma= strpos($coordenada,","); // Ubica la posición del caracter coma en la variable.
  $ubicacion_coma2 = $ubicacion_coma +1;
  $largo_cad = strlen($coordenada); // determina el largo de toda la cadena.
  $largo_lat = $largo_cad - $ubicacion_coma; 
  $latitud = substr($coordenada,0,$ubicacion_coma); // asigna la subcadena de coordenada que le corresponde a la latitud.
  $longitud = substr($coordenada,$ubicacion_coma2,$largo_lat); // asigna la subcadena de coordenada que le corresponde a la longitud
  
  
  $mysqli = new mysqli($host, $user, $pw, $db);
  $sql = "INSERT INTO Rango_parametros(Temperatura_max,Temperatura_min,Humedad_max,Humedad_min,Intensidad_luz_max,Intensidad_luz_min,Humedad_ambiente_max,Humedad_ambiente_min) 
            VALUES ('$temp_max','$temp_min','$hum_max','$hum_min','$luz_max','$luz_min','$humAmb_max','$humAmb_min')";
  $result1 = $mysqli->query($sql);
  
  if ($result1 == 1) 
    {
        // Selecciona el id del ultimo registro agregado en los rangos
        //  para asociarlo con el dispositivo
        $sql = "SELECT Id from Rango_parametros order by Id DESC LIMIT 1"; 
          
        $result1 = $mysqli->query($sql);
        $row1 = $result1->fetch_array(MYSQLI_NUM);
        $num_filas = $result1->num_rows;
                                              
        // Verifica si se obtuvo algun id
        if ($num_filas > 0) 
            {
                //agrega el dispositivo
                $sql = "INSERT INTO Dispositivo(Estado,Nombre,Latitud,Longitud,Id_usuario,Id_rango) 
                VALUES ('Activo','$nombre','$latitud','$longitud','$id_usuario','$row1[0]')";
                //echo "sql es...".$sql; //sirve para observar que es lo que se esta enviando
                $result1 = $mysqli->query($sql);
                if ($result1 == 1) 
                  {
                    echo "<div class=\"Mensaje\" style=\"color:blue; padding-bottom: 15px; font-size: 0.9rem;\">
                                    <span>Dispositivo agregado correctamente.</span>                         
				          </div>";   //Mensaje si se registro satisfactoriamente
                  }
                else
                    echo "<div class=\"Mensaje\" style=\"color:red; padding-bottom: 15px; font-size: 0.9rem;\">
        	                        <span>Error al agregar el dispostivo.</span>                         
        	              </div>";    //Mensaje si no se pudo registrar
            }
        else
            echo "<div class=\"Mensaje\" style=\"color:red; padding-bottom: 15px; font-size: 0.9rem;\">
                            <span>Error al agregar el dispostivo.</span>                         
                  </div>";     //Mensaje si no se pudo registrar
    }
    else
        echo "<div class=\"Mensaje\" style=\"color:red; padding-bottom: 15px; font-size: 0.9rem;\">
                        <span>Error al agregar el dispostivo.</span>                         
              </div>";     //Mensaje si no se pudo registrar

?>
  	
	 

   
