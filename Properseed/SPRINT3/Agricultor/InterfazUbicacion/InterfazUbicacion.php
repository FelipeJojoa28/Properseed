<?php
include "../../../SPRINT2/Autenticacion/SeguridadAgricultor.php";
include "conexion.php"; 
$mysqli = new mysqli($host, $user, $pw, $db);
$id_usu = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Gestión Dispositivos</title> 
    <meta charset="UTF-8">                                                      
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>    
  </head>  
  <body>
    
    <?php include "../../../SPRINT2/Agricultor/Panel/PanelAgricultor.php";?> <!-- Esto carga el panel superior e izquierdo del admin -->

      <div class="Contenedor">
        <div class="Formulario">
          <div class="Titulo">
            <div class="Cont-icon">
              <i class="fas fa-microchip"></i>
            </div>
            <h4 class="Name-titulo">Ubicación</h4> <!--Titulo-->
          </div>

          <div class="Contenido">

            <table class="Tabla_dispositivos">
              <thead>
                <tr>
                  <td style="text-align: center;">ID</td>
                  <td>Nombre</td>
                  <td>Latitud</td>
                  <td>Longitud</td>
                </tr>
              </thead>
              <tbody>
              <?php

              if ((isset($_POST["Ubicacion"]))){
              	$id_dis = $_POST["id_dis"];
 
                $sql1 = "SELECT * from Dispositivo where Id='$id_dis'";
                $result1 = $mysqli->query($sql1);
                $contador1 = 0;
                while($row1 = $result1->fetch_array(MYSQLI_NUM))
                {   
                    $id = $row1[0];
                    $estado = $row1[1];                          
                    $nombre = $row1[2];                           
                    $latitud = $row1[3];
                    $longitud = $row1[4];
                    $id_ran = $row1[5];
                    $contador1++;

                    if ($estado == 'Inactivo') {
                      ?>
                      <tr style="background-color: rgba(255, 50, 50, 0.15);">
                      <?php
                    }else{
                      ?>
                      <tr>
                      <?php
                    }
              ?>
                      <td style="text-align: center;" value=<?php echo $id;?>><?php echo $id;?></td>
                      <td><?php echo $nombre;?></td>
                      <td><?php echo $latitud;?></td>
                      <td><?php echo $longitud;?></td>                                                     
                    </tr>                                                                           
                <?php
                }
                }//Finaliza el while 
                ?>
                </tbody>              
            </table>
            <div id="map"></div>
          </div>          
        </div>
      </div>
    </section>


    <script>
      var map;

      var latit= <?php echo $latitud ?>;
      var longi= <?php echo $longitud ?>;
      var ubi_central = {lat: latit, lng: longi};

      function initMap() {
        var latit= <?php echo $latitud ?>;
        var longi= <?php echo $longitud ?>;
        var uluru = {lat: latit, lng: longi};
        
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          icon: 'icons/granja_inteligente.png',
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDf8K2Ty_mGpAB7UdkBz-kP_pIcQmVuVbo&callback=initMap">  <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
    </script>
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>