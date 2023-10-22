<?php
include "../../Autenticacion/SeguridadAgricultor.php"; 
// Colocarlo en las paginas del administrador
include "conexion.php";                                                 
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Registros entre Fechas</title> 
    <meta charset="UTF-8">       
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">   
  </head>  
  <body>

    <?php include "../Panel/PanelAgricultor.php";?> <!-- Esto carga el panel superior e izquierdo del agricultor -->

      <div class="Contenedor">
        <!-- AQUI VA EL CODIGO PARA DE LAS DEMAS TAREAS -->
         <div class="Formulario">
            <div class="Titulo">
              <div class="Cont-icon">
                <i class="fas fa-user-edit"></i>
              </div>
              <h4 class="Name-titulo">REGISTROS ENTRE FECHAS</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
<?php
$id=$_SESSION["id"];                    //id del usuario agricultor
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   
   if ($enviado == "S1")
    {
//  $ID_USU = $_POST["ID_USU"]; 
    $id_disp = $_POST["ID_DISP"];
    $fecha_ini = $_POST["fecha_ini"];
    $fecha_fin = $_POST["fecha_fin"];
    $sql1 = "SELECT * from Parametros where Id_dispositivo='$id_disp' and Fecha >= '$fecha_ini' and Fecha <= '$fecha_fin' order by Fecha";
    $result1 = $mysqli->query($sql1);
    $contador1 = 0;
    while($row1 = $result1->fetch_array(MYSQLI_NUM))
    {
        $contador1++;
    }//Finaliza el while 
    if($contador1>0){    
?>                
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Temperatura(°C)</th>
                          <th>Humedad del suelo (%)</th>
                          <th>Precipitaciones</th>
                          <th>Radiación solar (%)</th>
                          <th>Humedad ambiental (%)</th>                          
                          <th>Fecha</th>
                          <th>Hora</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php  
                    $sql2 = "SELECT * from Parametros where Id_dispositivo='$id_disp' and Fecha >= '$fecha_ini' and Fecha <= '$fecha_fin' order by Fecha";
                    $result2 = $mysqli->query($sql2);
                    $contador2 = 0;
                    while($row2 = $result2->fetch_array(MYSQLI_NUM))
                    {
                        $temp = $row2[1];                          //Almacena el id del dispositivo
                        $hum_sue = $row2[2];                           //ALmacena el nombre del dispositivo
                        $hum_amb = $row2[3];
                        $prec = $row2[4];
                        $luz = $row2[5];
                        $fecha = $row2[6];
                        $hora = $row2[7];
                        $contador2++;
                    ?>
                        <tr>
                          <td><?php echo $contador2;?></td>
                          <td><?php echo $temp;?></td>
                          <td><?php echo $hum_sue;?></td>
                          <td><?php echo $hum_amb;?></td>
                          <td><?php echo $prec;?></td>
                          <td><?php echo $luz;?></td>
                          <td><?php echo $fecha;?></td>
                          <td><?php echo $hora;?></td>
                          </td>
                        </tr>                                                                           
<?php
}              //Finaliza el while 
?>
                        
                      </tbody>
                    </table>
                  </div>
<?php
}
else{?>
    <div class="subtitulo_No_Datos">
  		<label>El dispositivo seleccionado no tiene datos registrados en el rango ingresado</label>           		   		
   	</div>
<?php           		
}
}
}
?>
          </div>          
<div class="BarraInferior">             
                  <input type="button" class="btn_cancelar" align="right" value="Volver" onClick="location.href='InterfazSeleccionarFecha.php'">
                      </div>
      
        </div> 
        </div> 
          

      </div>      
    </section>
    <script type="text/javascript" src="Agricultor/MenuAgricultor/Eventos.js"></script>
  </body>  
</html>

