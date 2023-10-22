<?php
include "../../../SPRINT2/Autenticacion/SeguridadAgricultor.php";
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
              <h4 class="Name-titulo">Nuevas alertas</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
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
                    $contador1 = 0;
                    $numero_filas = $result1->num_rows;
                    if($numero_filas > 0){
                        while($row1 = $result1->fetch_array(MYSQLI_NUM))
                        {                        
                            $ids_disp[$contador1] = $row1[0];      //ALmacena el nombre del dispositivo       
                            $contador1++;
                        }
                    }
                    
	                $sql1 = "SELECT * from Alerta where Revisada='0' ";
                    if($numero_filas > 0){
                        $sql1 .= "AND ("; 
                        foreach ($ids_disp as $id_disp) {
                            $sql1.= " Id_dispositivo = $id_disp OR";
                        }
                        $sql1 = substr($sql1,0,-2);
                        $sql1 .= ") ";
                    }
                    $sql1 .= "ORDER BY Id DESC";
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
	                $sql1 = "UPDATE Alerta SET revisada = '1' WHERE Revisada='0' ";
                    if($numero_filas > 0){
                        $sql1 .= "AND ("; 
                        foreach ($ids_disp as $id_disp) {
                            $sql1.= " Id_dispositivo = $id_disp OR";
                        }
                        $sql1 = substr($sql1,0,-2);
                        $sql1 .= ") ";
                        $result1 = $mysqli->query($sql1);
                    }
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

