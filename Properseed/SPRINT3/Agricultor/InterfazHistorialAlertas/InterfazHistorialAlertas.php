<?php
include "../../../SPRINT2/Autenticacion/SeguridadAgricultor.php";
// Colocarlo en las paginas del administrador
include "conexion.php";                                                 
$mysqli = new mysqli($host, $user, $pw, $db);
$id_usuario = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Alertas</title> 
    <meta charset="UTF-8">       
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
  </head>  
  <body>

    <?php include "../../../SPRINT2/Agricultor/Panel/PanelAgricultor.php";?> <!-- Esto carga el panel superior e izquierdo del agricultor -->

      <div class="Contenedor">
        <!-- AQUI VA EL CODIGO PARA DE LAS DEMAS TAREAS -->
         <div class="Formulario">
            <div class="Titulo">
              <div class="Cont-icon">
                <i class="fas fa-exclamation-circle"></i>
              </div>
              <h4 class="Name-titulo">Historial de alertas</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
            	<form method="POST" action="InterfazHistorialAlertas.php">
	              <table class="Filtros" width=100%>
	                <?php
	                   if ((isset($_POST["filtrar"]))){
	                     $select = $_POST["select"];
	                     $selectDisp = $_POST["selectDisp"];
	                     $filas = $_POST["filas"];
	                     $fecha_inicio = $_POST["fecha_inicio"]; 
	                     $fecha_fin = $_POST["fecha_fin"]; 

	                      ?>
	                      <tr>
	                      <td class="Atributo">
	                      <font>Variable:</font>
	                      <select name="select">
	                      <?php
	                      if ($select != "nombre"){  
	                        if ($select == "todos")
	                         {
	                          ?>
	                          <option value=todos selected>Todos</option>
	                          <option value=temperatura>Temperatura</option>
	                          <option value=humedad_suelo>Humedad del suelo</option> 
	                          <option value=humedad_ambiente>Humedad del ambiente</option>
	                          <option value=precipitaciones>Precipitaciones</option>
	                          <option value=intensidad_luz_solar>Intensidad de luz solar</option>
	                          <?php
	                         }
	                          else if ($select == "temperatura")
	                         {
	                          ?>
	                          <option value=todos>Todos</option>
	                          <option value=temperatura selected>Temperatura</option>
	                          <option value=humedad_suelo>Humedad del suelo</option> 
	                          <option value=humedad_ambiente>Humedad del ambiente</option>
	                          <option value=precipitaciones>Precipitaciones</option>
	                          <option value=intensidad_luz_solar>Intensidad de luz solar</option>
	                          <?php
	                         }
	                          else if ($select == "humedad_suelo")
	                         {
	                          ?>
	                          <option value=todos>Todos</option>
	                          <option value=temperatura>Temperatura</option>
	                          <option value=humedad_suelo selected>Humedad del suelo</option> 
	                          <option value=humedad_ambiente>Humedad del ambiente</option>
	                          <option value=precipitaciones>Precipitaciones</option>
	                          <option value=intensidad_luz_solar>Intensidad de luz solar</option>
	                          <?php
	                         }
	                          else if ($select == "humedad_ambiente")
	                         { 
	                          ?>
	                          <option value=todos>Todos</option>
	                          <option value=temperatura>Temperatura</option>
	                          <option value=humedad_suelo>Humedad del suelo</option> 
	                          <option value=humedad_ambiente selected>Humedad del ambiente</option>
	                          <option value=precipitaciones>Precipitaciones</option>
	                          <option value=intensidad_luz_solar>Intensidad de luz solar</option>
	                          <?php
	                         }
	                          else if ($select == "precipitaciones")
	                         { 
	                          ?>
	                          <option value=todos>Todos</option>
	                          <option value=temperatura>Temperatura</option>
	                          <option value=humedad_suelo>Humedad del suelo</option> 
	                          <option value=humedad_ambiente>Humedad del ambiente</option>
	                          <option value=precipitaciones selected>Precipitaciones</option>
	                          <option value=intensidad_luz_solar>Intensidad de luz solar</option>
	                          <?php
	                         }
	                          else if ($select == "intensidad_luz_solar")
	                         { 
	                          ?>
	                          <option value=todos>Todos</option>
	                          <option value=temperatura>Temperatura</option>
	                          <option value=humedad_suelo>Humedad del suelo</option> 
	                          <option value=humedad_ambiente>Humedad del ambiente</option>
	                          <option value=precipitaciones>Precipitaciones</option>
	                          <option value=intensidad_luz_solar selected>Intensidad de luz solar</option>
	                          <?php
	                         }
	                      }else{
	                        ?>
	                       	  <option value=todos>Todos</option>
	                          <option value=temperatura>Temperatura</option>
	                          <option value=humedad_suelo>Humedad del suelo</option> 
	                          <option value=humedad_ambiente>Humedad del ambiente</option>
	                          <option value=precipitaciones>Precipitaciones</option>
	                          <option value=intensidad_luz_solar>Intensidad de luz solar</option>
	                        <?php
	                      }
	                      ?>
	                      </select>
	                      <font>Dispositivo:</font>
	                      <select name="selectDisp">
	                          <option value=0>Todos</option>
                            <?php  
                                $sql1 = "SELECT * from Dispositivo where Id_usuario='$id_usuario'";
                                $result1 = $mysqli->query($sql1);
                                while($row1 = $result1->fetch_array(MYSQLI_NUM))
                                {       
                                    $seleccion = "";
                                    $nombre = $row1[2];                           //ALmacena el nombre del dispositivo          
                                    $ID_DISP = $row1[0];
                                    if($ID_DISP == $selectDisp)
                                        $seleccion = "selected";
                            ?>
                                <option value=<?php echo $ID_DISP;?> <?php echo $seleccion;?>><?php echo $nombre;?></option>                                                                           
                            <?php
                                }              //Finaliza el while 
                            ?>
	                          </select> 
	                        <button class="Btn-filas" type="submit"><i class="fas fa-search"></i></button>
	                      </td>
	                      <td class="Filas" align=right>
	                        <font class="Text-filas">Numero filas: </font>
	                      <?php
	                        if ($filas != ""){
	                          ?>
	                          <input class="Number-filas" type="number" name="filas" min="1" value=<?php echo $filas; ?> required>
	                          <?php
	                        }else{
	                          ?>
	                          $filas = "10";
	                          <input class="Number-filas" type="number" name="filas" min="1" value=<?php echo $filas;?> required>
	                          <?php
	                        }
	                      ?>
	                        <button class="Btn-filas" type="submit"><i class="fas fa-search"></i></button>
	                      </td>
	                      </tr>
	                      
	                      <tr>
	                          <tr class="Fecha">
    	                      	<td>
    	                      		<font>Fecha inicio:</font>
    	                      		<?php
    	                      		if($fecha_inicio != ""){
    	                      		    ?>
    	                      		    <input  type="date" name="fecha_inicio" value=<?php echo $fecha_inicio;?>>
    	                      		    <?php
    	                      		}else{
    	                      		    ?>
    	                      		    <input  type="date" name="fecha_inicio">
    	                      		    <?php
    	                      		}
    	                      		?>
    	                      	</td>
    	                      </tr>
    	                      <tr>
    	                      	<td  class="Text-fecha">
    	                      		<font class="Text-fecha">Fecha fin:  </font>
    	                      		<?php
    	                      		if($fecha_fin != ""){
    	                      		    ?>
    	                      		    <input  type="date" name="fecha_fin" value=<?php echo $fecha_fin;?>>
    	                      		    <?php
    	                      		}else{
    	                      		    ?>
    	                      		    <input  type="date" name="fecha_fin">
    	                      		    <?php
    	                      		}
    	                      		?>
    	                      	</td>
    	                      </tr>
	                      </tr>
	                      

	                      <?php
	                    }else
	                    {
	                ?> 
	                      <tr>
	                        <td class="Atributo">
	                          <font>Variable:</font>
	                          <select name="select">
	                          	<option value=todos>Todos</option>
	                            <option value=temperatura>Temperatura</option>
		                        <option value=humedad_suelo>Humedad del suelo</option> 
		                        <option value=humedad_ambiente>Humedad del ambiente</option>
		                        <option value=precipitaciones>Precipitaciones</option>
		                        <option value=intensidad_luz_solar>Intensidad de luz solar</option>
	                          </select>
	                          <font>Dispositivo:</font>
	                          <select name="selectDisp">
	                            <option value=0>Todos</option>
                            <?php  
                                $sql1 = "SELECT * from Dispositivo where Id_usuario='$id_usuario'";
                                $result1 = $mysqli->query($sql1);
                                while($row1 = $result1->fetch_array(MYSQLI_NUM))
                                {                        
                                    $nombre = $row1[2];                           //ALmacena el nombre del dispositivo          
                                    $ID_DISP = $row1[0];
                            ?>
                                <option value=<?php echo $ID_DISP;?>><?php echo $nombre;?></option>                                                                           
                            <?php
                                }              //Finaliza el while 
                            ?>
	                          </select> 
	                          <button class="Btn-filas" type="submit"><i class="fas fa-search"></i></button>
	                        </td>
	                        <td class="Filas" align=right>
	                          <font class="Text-filas">Numero filas:</font>
	                          <?php $filas = "10"; ?>
	                          <input class="Number-filas" type="number" name="filas" min="1" value=<?php echo $filas;?> required>
	                          <button class="Btn-filas" type="submit"><i class="fas fa-search"></i></button>
	                        </td>
	                      </tr>
	                      <tr>
	                          <tr class="Fecha">
    	                      	<td>
    	                      		<font>Fecha inicio:</font>
    	                      		<input  type="date" name="fecha_inicio">
    	                      	</td>
    	                      </tr>
    	                      <tr>
    	                      	<td  class="Text-fecha">
    	                      		<font class="Text-fecha">Fecha fin:  </font>
    	                      		<input class="Input-fecha" type="date" name="fecha_fin">
    	                      	</td>
    	                      </tr>
	                      </tr>
	                <?php
	                    }
	                ?>
	              </table>
	              <input type="hidden" value="1" name="filtrar">
	            </form>

	            <table class="Tabla_alertas">
	              <thead>
	                <tr>
	                  <td>#</td>
	                  <td style="text-align: center;">Dispositivo</td>
	                  <td>Variable</td>
	                  <td>Descripción</td>
	                  <td>Valor</td>
	                  <td>Máximo</td>
	                  <td>Mínimo</td>
	                  <td>Fecha</td>
	                  <td>Hora</td>
	                </tr>
	              </thead>
	              <tbody>
                    <?php
                        $sql1 = "SELECT Id from Dispositivo WHERE Id_usuario = $id_usuario";
                        $result1 = $mysqli->query($sql1);
                        $contador = 0;
                        $numero_filas = $result1->num_rows;
                        if($numero_filas > 0){
                            while($row1 = $result1->fetch_array(MYSQLI_NUM))
                            {                        
                                $ids_disp[$contador] = $row1[0];      //ALmacena el nombre del dispositivo                        
                                $contador++;
                            }
                        }
                        
        	            if ((isset($_POST["filtrar"]))){
        //modificar las consultas a la base de datos
                                $sql1 = "SELECT * from Alerta WHERE ";
                                
                                if($fecha_inicio != "" and $fecha_fin != "")
                                    $sql1 .= "Fecha>='$fecha_inicio' AND Fecha<='$fecha_fin' ";
                                else if($fecha_inicio != "")
                                    $sql1 .= "Fecha>='$fecha_inicio' ";
                                else if($fecha_fin != "")
                                    $sql1 .= "Fecha<='$fecha_fin' ";
                                else
                                    $sql1 .= "1 ";
                                    
                                if ($select == "temperatura")
                                    $sql1 .= "AND Nombre = 'Temperatura' ";
                                else if ($select == "humedad_suelo")
                                    $sql1 .= "AND Nombre = 'Humedad del suelo' ";
                                else if ($select == "humedad_ambiente")
                                    $sql1 .= "AND Nombre = 'Humedad del ambiente' ";
                                else if ($select == "intensidad_luz_solar")
                                    $sql1 .= "AND Nombre = 'Intensidad de luz solar' ";
                                
                                if ($selectDisp != 0)
                                    $sql1 .="AND Id_dispositivo = '$selectDisp' ";
                                
                                if($numero_filas > 0){
                                    $sql1 .= "AND ("; 
                                    foreach ($ids_disp as $id_disp) {
                                        $sql1.= " Id_dispositivo = $id_disp OR";
                                    }
                                    $sql1 = substr($sql1,0,-2);
                                    $sql1 .= ") ";
                                }
                                
                                $sql1 .= "ORDER BY Id DESC LIMIT $filas";
                        }else{
        	                $sql1 = "SELECT * from Alerta WHERE";
                            if($numero_filas > 0){
                                foreach ($ids_disp as $id_disp) {
                                    $sql1.= " Id_dispositivo = $id_disp OR";
                                }
                                $sql1 = substr($sql1,0,-2);
                            }
                            $sql1 .= "ORDER BY Id DESC LIMIT $filas";
                        }
    	                $result1 = $mysqli->query($sql1);
    	                $contador1 = 0;
    	                while($row1 = $result1->fetch_array(MYSQLI_NUM))
    	                {   
    	                    $id = $row1[0];
    	                    $variable = $row1[1];
    	                    if ($variable == "Temperatura")
    	                        $unidad = "°C";
    	                    else
    	                        $unidad = "%";
    	                    $tipo = $row1[2];   
    	                    $valor = $row1[3];     
    	                    $max = $row1[4];   
    	                    $min = $row1[5];   
    	                    $fecha = $row1[6];
    	                    $hora = $row1[7];
    	                    $revisada = $row1[8];
    	                    $id_dis = $row1[9];
    	                    $sql = "SELECT Nombre FROM Dispositivo WHERE Id = $id_dis";
    	                    $result = $mysqli->query($sql);
    	                    $row = $result->fetch_array(MYSQLI_NUM);
    	                    $nombre_dis = $row[0];
    	                    $contador1++;
	              ?>
              			<tr>
              			    <td><?php echo $contador1;?></td>
	                        <td style="text-align: center;" value=<?php echo $id_dis;?>><?php echo $nombre_dis;?> (<?php echo $id_dis;?>)</td>
	                        <td><?php echo $variable."(".$unidad.")";?></td>
	                        <td><?php echo $tipo;?></td>
	                        <td><?php echo $valor;?></td>
	                        <td><?php echo $max;?></td>
	                        <td><?php echo $min;?></td>
	                        <td><?php echo $fecha;?></td>
	                        <td><?php echo $hora;?></td> 
	                    </tr>                                                       
	                <?php
	                }              //Finaliza el while 
	                ?>
	                </tbody>              
	            </table>
      		</div>
      	</div>
      </div>          
    </section>
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>

