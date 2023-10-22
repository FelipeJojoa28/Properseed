<?php
include "../../../SPRINT2/Autenticacion/SeguridadAgricultor.php";
include "conexion.php"; 
$mysqli = new mysqli($host, $user, $pw, $db);
$id_usu = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Rango</title> 
    <meta charset="UTF-8">                                                      
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>    
  </head>  
  <body>
    
    <?php include "../../../SPRINT2/Agricultor/Panel/PanelAgricultor.php";?> <!-- Esto carga el panel superior e izquierdo del admin -->

	<div class="Contenedor">
	    <div class="Rango-parametros">
	      <div class="Titulo">
	        <div class="Cont-icon">
	          <i class="fas fa-sliders-h"></i>
	        </div>
	        <h4 class="Name-titulo">Rangos maximos y minimos</h4> <!--Titulo-->
	      </div>

	      <div class="Contenido">
	      	<?php
             if ((isset($_POST["ConsultarRango"]))){
                    $id_dis = $_POST["id_dis"];
                    $sql1 = "SELECT * from Dispositivo where Id='$id_dis'";
                    $result1 = $mysqli->query($sql1);
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {
                      $id_rango = $row1[6];
                    }

                    $sql1 = "SELECT * from Rango_parametros where Id='$id_rango'";
                    $result1 = $mysqli->query($sql1);
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {
                      $temperatura_max = $row1[1];
                      $temperatura_min = $row1[2];
                      $humedad_ambiente_max = $row1[3];
                      $humedad_ambiente_min = $row1[4];
                      $Intensidad_luz_max = $row1[5];
                      $Intensidad_luz_min = $row1[6];
                      $humedad_suelo_max = $row1[7];
                      $humedad_suelo_min = $row1[8];
                    }

                    ?>
                    <table class="Tabla_rango">
                      <tr>
                        <td>Temperatura: </td>
                        <td class="Max">Maximo: <?php echo $temperatura_max;?> °C</td>
                        <td class="Min">Minimo: <?php echo $temperatura_min;?> °C</td>
                      </tr>
                      <tr>
                        <td>Humedad ambiente: </td>
                        <td class="Max">Maximo: <?php echo $humedad_ambiente_max;?> %</td>
                        <td class="Min">Minimo: <?php echo $humedad_ambiente_min;?> %</td>
                      </tr>
                      <tr>
                        <td>Humedad del suelo: </td>
                        <td class="Max">Maximo: <?php echo $humedad_suelo_max;?> %</td>
                        <td class="Min">Minimo: <?php echo $humedad_suelo_min;?> %</td>
                      </tr>
                      <tr>
                        <td>Intensidad de luz: </td>
                        <td class="Max">Maximo: <?php echo $Intensidad_luz_max;?> %</td>
                        <td class="Min">Minimo: <?php echo $Intensidad_luz_min;?> %</td>
                      </tr>
                      </tr>
                    </table>
                  <?php
                  }else{
                    ?>
                      <table class="Advertencia">
                        <tr><td>No se encontro rango de parametros</td></tr>
                      </table>
                    <?php
                  }
                  ?>
	      </div>
	    </div>
	</div>
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>



