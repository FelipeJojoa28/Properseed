<?php
// Colocarlo en las paginas del administrador
include "conexion.php";                  
include "../../Autenticacion/SeguridadAdmin.php";
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Modificar Dispositivo</title> 
    <meta charset="UTF-8">                                                 
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>                     
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script> 
	<meta name="viewport" content="width=device-width, initial-scale=1">       
  </head>  
  <body>
    
    <?php include "../Panel/PanelAdmin.php";?> <!-- Esto carga el panel superior e izquierdo del admin -->

      <div class="Contenedor">
        <!-- AQUI VA EL CODIGO PARA DE LAS DEMAS TAREAS -->
        <div class="Formulario">
            <div class="Titulo">
              <div class="Cont-icon">
                <i class="fas fa-user-plus"></i>
              </div>
            <h4 class="Name-titulo">Modificaciones al dispositivo </h4> <!--Titulo-->
            </div>
            <div class="Contenido">
<?php
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   
   if ($enviado == "S1")
    {
       $ID_USU = $_POST["ID_USU"]; 
       $id_disp = $_POST["id_disp"];
                      
$sql2 = "SELECT * from Dispositivo where Id_usuario='$ID_USU' and Id='$id_disp'";
$result2 = $mysqli->query($sql2);
$contador1 = 0;
while($row2 = $result2->fetch_array(MYSQLI_NUM))
{
//$id_disp = $row2[0];                          
$Estado = $row2[1];                           
$Nombre_disp = $row2[2];
$Longitud = $row2[4];
$Latitud = $row2[3];
$Id_rango = $row2[6];
 $contador1++;
}
$sql1 = "SELECT * from Rango_parametros where Id='$Id_rango'"; //Para recoger los valores max y min de las variables sensadas
$result1 = $mysqli->query($sql1);
while($row1 = $result1->fetch_array(MYSQLI_NUM))
{
 $id_rango = $row1[0];
 $temp_max = $row1[1];  
 $temp_min = $row1[2];                   
 $hum_max = $row1[3];
 $hum_min = $row1[4];
 $luz_max = $row1[5];
 $luz_min = $row1[6];
 $humAmb_max = $row1[7];
 $humAmb_min = $row1[8];
}        
        //Finaliza el while 
?>
                <form action="GuardarModificarDispositivo.php" method="post"><!-- registro -->
                   
                  <div class="form-group" style="color:#9E9E9E; font-size:15pt;">            <!--Para personalizar el color y tamaño de letra del listado-->                
                  <label>Datos del dispositivo: <?php echo $Nombre_disp?> </label> 
                    </div> 
                    
                   <div class="subtitulo_lat">
                    <label>Estado:</label>   		
           		    </div> 
                     <div class="div">
           		   		<select class="listado" name="Estado" required>
                    <?php
                            if($Estado=="Activo"){?>
                                <option data-tokens="Activo" selected>Activo</option>
                                <option data-tokens="Inactivo">Inactivo</option>      
                            <?php
                            }
                            else{?>
                                <option data-tokens="Inactivo" selected>Inactivo</option>
                                <option data-tokens="Inactivo">Activo</option>       
                            <?php
                            }
                        ?>      
                    </select>  
           		    </div>                                   		   
                    <div class="subtitulo_lat">
           		   		<label>Nombre:</label>           		   		
           		    </div>                                 		   
           		   <div class="div">
           		   		<input type="text" class="input" name="Nombre"  required value=<?php echo $Nombre_disp;?>>
           		    </div>
           		    	<div class="subtitulo" align="center">
           		   		<label>Valores M&aacuteximos y M&iacutenimos para alertas</label>           		   		
           		</div>
                <div class="subtitulo_lat">
           		   		<label>Temperatura (&degC):</label>           		   		
           		</div>                        
                <div class="input-div datoMax">           		   
           		   		<h5>M&aacuteximo</h5>
           		   <div class="div">
           		   	<input type="number" class="input" name="Temp_max" min="0" max="40" required value=<?php echo $temp_max;?>>
           		    </div>
           		</div>

                <div class="input-div datoMin">           		   
           		   		<h5>M&iacutenimo</h5>
           		   	 <div class="div">
           		   		<input type="number" class="input" name="Temp_min" min= "-6" max="0" required value=<?php echo $temp_min;?>>
           		   </div>
                </div> 
                <div class="subtitulo_lat">
           		   		<label>Humedad del suelo (%):</label>           		   		
           		</div>                        
                <div class="input-div datoMax">           		   
           		   		<h5>M&aacuteximo</h5>
           		   <div class="div">
           		   	<input type="number" class="input" min="0" max="100" name="Hum_max"  required value=<?php echo $hum_max;?>>
           		    </div>
           		</div>

                <div class="input-div datoMin">           		   
           		   		<h5>M&iacutenimo</h5>
           		   	 <div class="div">
           		   		<input type="number" class="input" min="0" max="100" name="Hum_min" required value=<?php echo $hum_min;?>>
           		   </div>
                </div>
                <div class="subtitulo_lat">
           		   		<label>Intensidad de luz solar (%):</label>           		   		
           		</div>                        
                <div class="input-div datoMax">           
           		   		<h5>M&aacuteximo</h5>
           		   <div class="div">
           		   	<input type="number" class="input" min="0" max="100" name="Luz_max"  required value=<?php echo $luz_max;?>>
           		    </div>
           		</div>

                <div class="input-div datoMin">           		   
           		   		<h5>M&iacutenimo</h5>
           		   	 <div class="div">
           		   		<input type="number" class="input" min="0" max="100" name="Luz_min" required value=<?php echo $luz_min;?>>
           		   </div>
                </div> 
                 <div class="subtitulo_lat">
           		   		<label>Humedad del ambiente (%):</label>           		   		
           		</div>                        
                <div class="input-div datoMax">           		   
           		   		<h5>M&aacuteximo</h5>
           		   <div class="div">
           		   		<input type="number" class="input" min="0" max="100" name="HumAmb_max"  required value=<?php echo $humAmb_max;?>>
           		    </div>
           		</div>

                <div class="input-div datoMin">           		   
           		   		<h5>M&iacutenimo</h5>
           		   	 <div class="div">
           		   		<input type="number" class="input" min="0" max="100" name="HumAmb_min" required value=<?php echo $humAmb_min;?>>
           		   </div>
                </div>                    
                    <div class="subtitulo_lat_mapa">
           		   		<label>Selecciones ubicación: </label>           		   		
           		</div>
                <div class="Contenedor_mapa">
                    <div id="map"></div>
                    <input type="text" id="coords" value="coords" name="Coordenada" />
                </div>
                           <div class="BarraInferior">             
                  <input type="hidden" name="enviado" value="S1">
                  <input type ="hidden" name="id_dis" value =<?php echo $id_disp;?>>
                  <input type ="hidden" name="id_rango" value =<?php echo $Id_rango;?>>
            	  <input type="submit" class="btn_form" value="Guardar">
                  <input type="button" class="btn_cancelar" align="right" value="Cancelar" onClick="location.href='InterfazSeleccionarUsuario.php'">
                      </div> 
           		</div>
                </form><!-- Cierrra form registro -->
<?php 
}                                           
}
?>
            </div>
        </div>
      </div>               
    </section>    
    <script>

        var marker;          //variable del marcador
      
        var latit= <?php echo $Latitud;?>;
        var longi= <?php echo $Longitud;?>;
        var coords={};
        //var coords = {lat:latit, lng:longi};    //coordenadas obtenidas con la geolocalizaci�n
      //var uluru = {lat: latit, lng: longi};
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
                coords= {lat: latit, lng: longi};
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
              document.getElementById("coords").value = coords.lat+","+ coords.lng;
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