<?php
include "../../Autenticacion/SeguridadAdmin.php";
// Colocarlo en las paginas del administrador
include "conexion.php";                                                 
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Últimos Registros</title> 
    <meta charset="UTF-8">       
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="Estilo2.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">   
  </head>  
  <body>

    <?php include "../Panel/PanelAdmin.php";?> <!-- Esto carga el panel superior e izquierdo del agricultor -->

      <div class="Contenedor">
        <!-- AQUI VA EL CODIGO PARA DE LAS DEMAS TAREAS -->
         <div class="Formulario">
            <div class="Titulo">
              <div class="Cont-icon">
                <i class="fas fa-history"></i>
              </div>
              <h4 class="Name-titulo">ÚLTIMOS REGISTROS</h4> <!--Titulo-->
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
    $sql1 = "SELECT * from Parametros where Id_dispositivo='$id_disp'";
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
                    $sql1 = "SELECT * from Parametros where Id_dispositivo='$id_disp' ORDER BY id desc LIMIT 5";
                    $result1 = $mysqli->query($sql1);
                    $contador1 = 0;
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {
                        $temp = $row1[1];                          //Almacena el id del dispositivo
                        $hum_sue = $row1[2];                           //ALmacena el nombre del dispositivo
                        $hum_amb = $row1[3];
                        $prec = $row1[4];
                        $luz = $row1[5];
                        $fecha = $row1[6];
                        $hora = $row1[7];
                        $contador1++;
                    ?>
                        <tr>
                          <td><?php echo $contador1;?></td>
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
}              //Finaliza el if
else{?>
    <div class="subtitulo_No_Datos">
  		<label>El dispositivo seleccionado no tiene datos registrados</label>           		   		
   	</div>
<?php           		
}
}
}
?>          
<div class="BarraInferior">             
                  <input type="button" class="btn_cancelar" align="right" value="Volver" onClick="location.href='InterfazSeleccionarDispositivo.php'">
                      </div>
      
        </div> 
      </div>
      </div>          
    </section>
    <script type="text/javascript" src="Agricultor/MenuAgricultor/Eventos.js"></script>
  </body>  
</html>

