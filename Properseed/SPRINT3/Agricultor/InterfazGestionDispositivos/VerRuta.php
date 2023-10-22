<?php
//include "../../Autenticacion/SeguridadAgricultor.php";
// Colocarlo en las paginas del administrador
include "conexion.php";                                                 
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Ver ruta</title> 
    <meta charset="UTF-8">       
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>

    <?php include "../../../SPRINT2/Agricultor/Panel/PanelAgricultor.php";?> <!-- Esto carga el panel superior e izquierdo del agricultor -->

      <div class="Contenedor">
        <!-- AQUI VA EL CODIGO PARA DE LAS DEMAS TAREAS -->
         <div class="Formulario">
            <div class="Titulo">
              <div class="Cont-icon">
                <i class="fas fa-bus"></i>
              </div>
              <h4 class="Name-titulo">Ver ruta</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
<?php
//$id=$_SESSION["id"];                    //id del usuario agricultor
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   
   if ($enviado == "S1")
    {
//  $ID_USU = $_POST["ID_USU"]; 
    $id_ruta = $_POST["ID_Ruta"];
    $sql1 = "SELECT * from ruta where id='$id_ruta'";
    $result1 = $mysqli->query($sql1);
    $contador1 = 0;
    while($row1 = $result1->fetch_array(MYSQLI_NUM))
    {
      $enlace = $row1[4];  
      $contador1++;
    }//Finaliza el while 
    if($contador1>0){    
?>         

        <div id="map">
            <iframe src=<?php echo $enlace;?> width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
                                                                                                     
          

<?php
}              //Finaliza el if
else{?>
    <div class="subtitulo_No_Datos">
  		<label>Error</label>           		   		
   	</div>
<?php           		
}
}
}
?>          
<div class="BarraInferior">             
    <input type="button" class="btn_cancelar" align="right" value="Volver" onClick="location.href='InterfazGestionDispositivos.php'">
</div>
      
        </div> 
      </div>
      </div>          
    </section>
    <script type="text/javascript" src="Agricultor/MenuAgricultor/Eventos.js"></script>
  </body>  
</html>

