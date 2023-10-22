<?php
//include "../../../SPRINT2/Autenticacion/SeguridadAgricultor.php";
include "conexion.php"; 
$mysqli = new mysqli($host, $user, $pw, $db);
//$id_usu = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="es">  
<head>    
    <title>Consultar ruta</title> 
    <meta charset="UTF-8">   
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">   
  </head> 
  <body>
    
    <?php include "../../../SPRINT2/Agricultor/Panel/PanelAgricultor.php";?> <!-- Esto carga el panel superior e izquierdo del admin -->

      <div class="Contenedor">
        <div class="Formulario">
          <div class="Titulo">
            <div class="Cont-icon">
              <i class="fas fa-bus"></i>
            </div>
            <h4 class="Name-titulo">Consultar ruta</h4> <!--Titulo-->
          </div>

          <div class="Contenido">

          <form action="VerRuta.php" method="POST"><!-- registro -->
                                  
                                                        
                                  <label>Seleccione una ruta:</label>
                                  <select name="ID_Ruta">
                                  <?php  
                                  //$id=$_SESSION["id"];
                                  $sql1 = "SELECT * from ruta";
                                  $result1 = $mysqli->query($sql1);
                                  $contador1 = 0;
                                  while($row1 = $result1->fetch_array(MYSQLI_NUM))
                                  {                        
                                      $id_ruta = $row1[0];                           //ALmacena el nombre del dispositivo                                                              
                                      $nombre_empresa = $row1[1];
                                      $contador1++;
                                  ?>
                                  <option value=<?php echo $id_ruta;?>><?php echo $nombre_empresa," ",$id_ruta;?></option>                                                                           
              <?php
              }              //Finaliza el while 
              ?>
                                        
                                  </select>   
                                  <div class="BarraBotonMod">                  
                                <input type="hidden" name="enviado" value="S1">  
                               <input type="submit" class="btn_form" value="Consultar">
                            </div>
                                                                                            
                              
                            
                            
              </form><!-- Cierrra form registro -->     
            
           
          </div>          
        </div>
      </div>
    </section>


    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>



