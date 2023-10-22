<?php
// Colocarlo en las paginas del administrador
include "conexion.php";                  
include "../../Autenticacion/SeguridadAdmin.php";
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Últimos Registros</title> 
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
                <i class="fas fa-chart-line"></i>
              </div>
              <h4 class="Name-titulo">USUARIOS</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
<?php              
    if (isset($_GET["mensaje"]))
    {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){
            if($mensaje==1){?>
              <div class="Mensaje" style="color:blue; padding-bottom: 15px; font-size: 0.9rem;">
						<span>
						<?php 
							echo "Cambios guardados con éxito.";
						?>
						</span>                         
					</div>  
					<?php
            }
            else {
                ?>
              <div class="Mensaje" style="color:red; padding-bottom: 15px; font-size: 0.9rem;">
						<span>
						<?php 
							echo "Error al guardar.";
						?>
						</span>                         
					</div>  
					<?php
            }
}
}
?>
                    <form action="InterfazSeleccionarDispositivo.php" method="POST"><!-- registro -->                                  
                    <div class="form-group" style="color:#9E9E9E; font-size:15pt;"> 
                    <label>Seleccione un agricultor:</label>
                    <select name="ID_USU" style ="color: black;">
                    <?php  
                    $sql1 = "SELECT * from Usuario where Tipo = 'Agricultor'";
                    $result1 = $mysqli->query($sql1);
                    $contador1 = 0;
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {
                        $ID_USU = $row1[0];
                        $tipo = $row1[1];                         
                        $apellido = $row1[2];
                        $nombre = $row1[3];                       
                        $cedula = $row1[4];
                        $contador1++;
                        $sql2 = "SELECT * from Dispositivo where Id_usuario='$ID_USU'";
                        $result2 = $mysqli->query($sql2);
                        $contador2 = 0;
                        while($row2 = $result2->fetch_array(MYSQLI_NUM))
                        {                        
                            $contador2++;
                        }
                        if($contador2>0){    
                    ?>
                    <option value=<?php echo $ID_USU;?>><?php echo $nombre." ".$apellido;?></option>                                                                           
<?php
}
}              //Finaliza el while 
?>
                    </select>        
                    </div>
                                                                           
                <div class="BarraBotonMod">                  
                  <input type="hidden" name="enviado" value="S1">  
           		  <input type="submit" class="btn_form" value="Continuar">
              </div>                                                                                                                      
                <div class="table-responsive">
                     <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>C&eacutedula</th>
                          <th>Tipo de usuario</th>                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php  
                    $sql1 = "SELECT * from Usuario where Tipo = 'Agricultor'";
                    $result1 = $mysqli->query($sql1);
                    $contador1 = 0;
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {
                        $tipo = $row1[1];                          //Almacena el id del dispositivo
                        $nombre = $row1[3];                           //ALmacena el nombre del dispositivo
                        $apellido = $row1[2];
                        $cedula = $row1[4];
                        $nickname = $row1[5];
                        $contador1++;   
                    ?>
                        <tr>
                          <td><?php echo $contador1;?></td>
                          <td><?php echo $nombre;?></td>
                          <td><?php echo $apellido;?></td>
                          <td><?php echo $cedula;?></td>
                          <td><?php echo $tipo;?></td>                                                      
                          </td>
                        </tr>                                                                           
<?php
}              //Finaliza el while 
?>
                        
                      </tbody>
                    </table>
                  </div>      
</form><!-- Cierrra form registro -->                                                                     
          </div>          

        </div>
      </div>
    </section>
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>



