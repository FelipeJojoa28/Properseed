<?php
// Colocarlo en las paginas del administrador
include "conexion.php";                  
include "../../Autenticacion/SeguridadAdmin.php";
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Seleccionar Dispositivo</title> 
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
                <i class="fas fa-user-edit"></i>
              </div>
              <h4 class="Name-titulo">DISPOSITIVOS </h4> <!--Titulo-->
            </div>
            <div class="Contenido">
             <?php
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
       $ID_USU = $_POST["ID_USU"];                
$sql1 = "SELECT * from Usuario where id=$ID_USU"; //Para recoger los datos del user
$result1 = $mysqli->query($sql1);
$contador = 0;
while($row1 = $result1->fetch_array(MYSQLI_NUM))
{
 $tipo = $row1[1];  
 $nombre_usu = $row1[3];                   
 $apellido_usu = $row1[2];
 $cedula = $row1[4];
 $usuario = $row1[5];
 $contrasena = $row1[6];
 $estado = $row1[7];
 $contador++;                                                                                                     
}
?>
                    <form action="InterfazModificarDispositivo.php" method="POST"><!-- registro -->                                    
                    <div class="form-group" style="color:#9E9E9E; font-size:15pt;"> 
                    <label>Seleccione un dispositivo: </label>
                    <select name="id_disp" style="color: black;">
                    <?php  
                    $sql1 = "SELECT * from Dispositivo where Id_usuario='$ID_USU'";
                    $result1 = $mysqli->query($sql1);
                    $contador1 = 0;
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {
                        $id_disp = $row1[0];                          
                        $Estado = $row1[1];                           
                        $Nombre_disp = $row1[2];
                        $Longitud = $row1[4];
                        $Latitud = $row1[3];
                        $contador1++;
                    ?>
                    <option value=<?php echo $id_disp;?>><?php echo $Nombre_disp;?></option>                                                                           
<?php
}              //Finaliza el while 
?>
                    </select>   
                    </div>
                <?php
              if ($contador1 > 0){
              ?>                                             
                <div class="BarraBotonMod">   
                   <input type= "hidden" name ="ID_USU" value =<?php echo $ID_USU;?>>               
                  <input type="hidden" name="enviado" value="S1">  
           		  <input type="submit" class="btn_form" value="Modificar">
              </div>                                                                                          
                <div class="table-responsive">
                    <table class="table">
           		   	<div class="form-group" style="color:#9E9E9E; font-size:15pt;"> 
                    <label>Dispositivos asociados a <?php echo $nombre_usu." ".$apellido_usu;?> </label>          		   		
           		    </div>
                      <thead>
                        <tr>  
                          <th class="text-center">ID</th>
                          <th>Nombre</th>
                          <th>Estado</th>
                          <th>Latitud (&deg)</th> 
                          <th>Longitud (&deg)</th>                         
                        </tr>
                      </thead>
                      <tbody>
                      <?php  
                    $sql1 = "SELECT * from Dispositivo where Id_usuario='$ID_USU' order by Id";
                    $result1 = $mysqli->query($sql1);
                    $contador1 = 0;
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {
                        $id = $row1[0];                          
                        $Estado = $row1[1];                           
                        $Nombre_disp = $row1[2];
                        $Longitud = $row1[4];
                        $Latitud = $row1[3];
                        $contador1++;
                    ?>
                        <tr>
                          <td><?php echo $id;?></td>
                          <td><?php echo $Nombre_disp;?></td>
                          <td><?php echo $Estado;?></td>
                          <td><?php echo $Latitud;?></td> 
                          <td><?php echo $Longitud;?></td>
                                                                               
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
else{
?> 
<div class="input-div datoMin">           		   
           		   <div class="div">
           		   		<h5>El usuario no tiene dispositivos asociados</h5>
           		   </div>
                </div>
<?php
}
?>                
</form><!-- Cierrra form registro -->    
<?php 
}
}
?>                                                                            
          </div>          
        </div>
      </div>
    </section>
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>



       