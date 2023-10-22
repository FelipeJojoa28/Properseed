<?php
// Colocarlo en las paginas del administrador
include "conexion.php";                  
include "../../Autenticacion/SeguridadAdmin.php";
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Agregar Dispositivo</title> 
    <meta charset="UTF-8">                                                 
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>                     
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script> 
	<meta name="viewport" content="width=device-width, initial-scale=1">       
  </head>  
  <body>
    
    <?php 
        include "../Panel/PanelAdmin.php";
    ?> <!-- Esto carga el panel superior e izquierdo del admin -->

      <div class="Contenedor">
        <!-- AQUI VA EL CODIGO PARA DE LAS DEMAS TAREAS -->
          <div class="Formulario">
            <div class="Titulo">
              <div class="Cont-icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <h4 class="Name-titulo">INGRESAR DATOS DE DISPOSITIVO NUEVO</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
                <?php 
                        if ((isset($_POST["enviado"])))
                            include "guardar_datos_dispositivo.php";
                ?> 
              <form action="InterfazAgregarDispositivo.php" method="post"><!-- registro -->
                  
                  <div class="form-group" style="color:#9E9E9E; font-size:15pt;">            <!--Para personalizar el color y tamaño de letra del listado-->                
                  <label>Usuario del dispositivo:</label>
                    <select name="Id_usuario"  style="color:black;">                         <!--El nombre del select indica la "variable" donde se guarda el ID del usuario escogido-->
                    <?php  
                    $sql1 = "SELECT * from Usuario WHERE Tipo='Agricultor'";               //Para que solo se pueda agregar dispositivos a usuarios agricultores
                    $result1 = $mysqli->query($sql1);
                    $contador1 = 0;
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {
                        $tipo = $row1[1];                          
                        $nombre = $row1[3];                  //En la base de datos del servidor en línea, primero está el apellido que el nombre      
                        $apellido = $row1[2];
                        $cedula = $row1[4];
                        $Id_usuario = $row1[0];
                        $contador1++;
                    ?>
                    <option value=<?php echo $Id_usuario;?>><?php echo $nombre." ".$apellido;?></option>                                                                           
<?php
}              //Finaliza el while 
?>
                          
                    </select>
                    </div>
                <div class="input-div nombre">           		   
           		   <div class="div">
           		   		<h5>Nombre de dispositivo</h5>
           		   		<input type="text" class="input" name="nombre_disp" required >
           		   </div>
           		  </div>                         
                           		   
           		<div class="subtitulo" align="center">
           		   		<label>Valores M&aacuteximos y M&iacutenimos para alertas</label>           		   		
           		</div>
                
                <div class="subtitulo_lat">
           		   		<label>Temperatura (&degC):</label>           		   		
           		</div>                        
                <div class="input-div datoMax">           		   
           		   <div class="div">
           		   		<h5>M&aacuteximo</h5>
           		   		<input type="number" class="input" name="Temp_max"  required>
           		   </div>
           		</div>

                <div class="input-div datoMin">           		   
           		   <div class="div">
           		   		<h5>M&iacutenimo</h5>
           		   		<input type="number" class="input" name="Temp_min" required>
           		   </div>
                </div> 
                <div class="subtitulo_lat">
           		   		<label>Humedad del suelo (%):</label>           		   		
           		</div>                        
                <div class="input-div datoMax">           		   
           		   <div class="div">
           		   		<h5>M&aacuteximo</h5>
           		   		<input type="number" class="input" min="0" max="100" name="Hum_max"  required>
           		   </div>
           		</div>

                <div class="input-div datoMin">           		   
           		   <div class="div">
           		   		<h5>M&iacutenimo</h5>
           		   		<input type="number" class="input" min="0" max="100" name="Hum_min" required>
           		   </div>
                </div>  
                <div class="subtitulo_lat">
           		   		<label>Intensidad de luz solar (%):</label>           		   		
           		</div>                        
                <div class="input-div datoMax">           		   
           		   <div class="div">
           		   		<h5>M&aacuteximo</h5>
           		   		<input type="number" class="input" min="0" max="100" name="Luz_max"  required>
           		   </div>
           		</div>

                <div class="input-div datoMin">           		   
           		   <div class="div">
           		   		<h5>M&iacutenimo</h5>
           		   		<input type="number" class="input" min="0" max="100" name="Luz_min" required>
           		   </div>
                </div>                             
                <div class="subtitulo_lat">
           		   		<label>Humedad del ambiente (%):</label>           		   		
           		</div>                        
                <div class="input-div datoMax">           		   
           		   <div class="div">
           		   		<h5>M&aacuteximo</h5>
           		   		<input type="number" class="input" min="0" max="100" name="HumAmb_max"  required>
           		   </div>
           		</div>

                <div class="input-div datoMin">           		   
           		   <div class="div">
           		   		<h5>M&iacutenimo</h5>
           		   		<input type="number" class="input" min="0" max="100" name="HumAmb_min" required>
           		   </div>
                </div>
                
                <div class="subtitulo_lat_mapa">
           		   		<label>Selecciones ubicación: </label>           		   		
           		</div>
                <div class="Contenedor_mapa">
                    <div id="map"></div>
                    <input type="text" id="coords" value="coords" name="coordena" />
                </div>
                
                <div class="BarraInferior">             
                  <input type="hidden" name="enviado" value="S1">  
           		  <input type="submit" class="btn_form" value="Registrar">
              </div>
            </form><!-- Cierrra form registro -->                                          
          </div>          
        </div>
      </div>
    </section>
    
    <script>

        var marker;          //variable del marcador
        var coords = {};    //coordenadas obtenidas con la geolocalizaci�n
        var latitud;
        var longitud;
        
        //Funcion principal
        initMap = function () {
    //        if (navigator.geolocation) {
    //            navigator.geolocation.getCurrentPosition(
    //            function (position){
    //               var coords =  {
    //                    lng: position.coords.longitude,
    //                    lat: position.coords.latitude
    //                }
    //            });
    //        }else {
                coords= {lat: 2.441111545, lng: -76.611114541};
    //        }        
            setMapa(coords);       
        //        },function(error){console.log(error);});
        }
        
        
        
        function setMapa (coords)
        {   
              //Se crea una nueva instancia del objeto mapa
              var map = new google.maps.Map(document.getElementById('map'),
              {
                zoom: 15,
                center:new google.maps.LatLng(coords.lat,coords.lng),
        
              });
        
              //Creamos el marcador en el mapa con sus propiedades
              //para nuestro obetivo tenemos que poner el atributo draggable en true
              //position pondremos las mismas coordenas que obtuvimos en la geolocalizaci�n
              marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(coords.lat,coords.lng),
        
              });
              
              document.getElementById("coords").value = coords.lat.toFixed(6)+","+ coords.lng.toFixed(6);
              //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
              //cuando el usuario a soltado el marcador
              marker.addListener('click', toggleBounce);
              
              marker.addListener( 'dragend', function (event)
              {
                //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                document.getElementById("coords").value = this.getPosition().lat().toFixed(6)+","+ this.getPosition().lng().toFixed(6);
              });
        }
        
        //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
        function toggleBounce() {
          if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
          } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
          }
        }
        // Carga de la libreria de google maps 
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDf8K2Ty_mGpAB7UdkBz-kP_pIcQmVuVbo&callback=initMap"></script> <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->

    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>
