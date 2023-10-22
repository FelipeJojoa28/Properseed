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
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">   
  </head>  
  <body>
<?php include "../Panel/PanelAdmin.php";?> <!-- Esto carga el panel superior e izquierdo del agricultor -->

      <div class="Contenedor">
<?php
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
       $ID_USU = $_POST["ID_USU"];                
?>
        <!-- AQUI VA EL CODIGO PARA DE LAS DEMAS TAREAS -->
         <div class="Formulario">
            <div class="Titulo">
              <div class="Cont-icon">
                <i class="fas fa-history"></i>
              </div>
              <h4 class="Name-titulo">ÚLTIMOS REGISTROS</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
              <form action="InterfazVerRegistros.php" method="POST"><!-- registro -->
                                  
                                                        
                    <label>Seleccione dispositivo a consultar:</label>
                    <select name="ID_DISP">
                    <?php  
                    $id=$_SESSION["id"];
                    $sql1 = "SELECT * from Dispositivo where Id_usuario='$ID_USU'";
                    $result1 = $mysqli->query($sql1);
                    $contador1 = 0;
                    while($row1 = $result1->fetch_array(MYSQLI_NUM))
                    {                        
                        $nombre = $row1[2];                           //ALmacena el nombre del dispositivo                        
                        $ID_DISP = $row1[0];
                        $contador1++;
                    ?>
                    <option value=<?php echo $ID_DISP;?>><?php echo $nombre;?></option>                                                                           
<?php
}              //Finaliza el while 
?>
                          
                    </select>   
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre del dispositivo</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php  
                    $sql2 = "SELECT * from Dispositivo where Id_usuario='$ID_USU'";
                    $result2 = $mysqli->query($sql2);
                    $contador2 = 0;
                    while($row2 = $result2->fetch_array(MYSQLI_NUM))
                    {                        
                        $nombre = $row2[2];                           //ALmacena el nombre del dispositivo 
                        $id_disp = $row2[0];
                        $contador2++;
                    ?>
                        <tr>
                          <td><?php echo $id_disp;?></td>
                          <td><?php echo $nombre;?></td>
                          </td>
                        </tr>                                                                           
<?php
}              //Finaliza el while 
?>
                        
                      </tbody>
                    </table>
                  </div>                                                              
                <div class="BarraBotonMod">                  
                  <input type="hidden" name="enviado" value="S1">  
           		  <input type="submit" class="btn_form" value="Consultar">
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
    <script type="text/javascript" src="Agricultor/MenuAgricultor/Eventos.js"></script>
  </body>  
</html>

