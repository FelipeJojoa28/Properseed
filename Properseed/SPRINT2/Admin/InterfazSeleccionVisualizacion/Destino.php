<?php
// Colocarlo en las paginas del administrador
include "../../Autenticacion/SeguridadAdmin.php"; 
include "conexion.php";
$mysqli = new mysqli($host, $user, $pw, $db);
ob_start();
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Gestión Usuarios</title> 
    <meta charset="UTF-8">                                                      
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script> 
	<meta name="viewport" content="width=device-width, initial-scale=1">   
  </head>  
  <body>
    
    <?php include "../Panel/PanelAdmin.php";?> <!-- Esto carga el panel superior e izquierdo del admin -->
    
      <div class="Contenedor">
        <div class="Formulario">
          <div class="Titulo">
            <div class="Cont-icon">
              <i class="fas fa-users-cog"></i>
            </div>
            <h4 class="Name-titulo">Opciones de visualizacion</h4> <!--Titulo-->
          </div>

          <div class="Contenido">
<?php
$id=$_SESSION["id"];                    //id del admin
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
    $ID_USU = $_POST["ID_USU"];
    $selected_var = $_POST["select"];
    $fecha_ini = $_POST["fecha_ini"];
    $fecha_fin = $_POST["fecha_fin"];
    $id_disp = $_POST["id_disp"];
    $sql1 = "SELECT * from Parametros where Id_dispositivo='$id_disp' AND Fecha >= '$fecha_ini' AND Fecha <= '$fecha_fin'";
    $result1 = $mysqli->query($sql1);
    $contador1 = 0; 
    while($row1 = $result1->fetch_array(MYSQLI_NUM))
    {
        $contador1++;
    }
    if($contador1>0){
echo $selected_var;

                      
                           if($selected_var == "Temperatura"){header("Location: ../../../SPRINT3/InterfazGraficasAdmin/generar_grafico_Temp.php?fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&selected_var=$selected_var&id_disp=$id_disp&ID_USU= $ID_USU");}
                       
                           else if ($selected_var == "H_suelo"){header("Location: ../../../SPRINT3/InterfazGraficasAdmin/generar_grafico_HumSue.php?fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&selected_var=$selected_var&id_disp=$id_disp&ID_USU= $ID_USU");}
                       
                           else if ($selected_var == "H_amb"){header("Location: ../../../SPRINT3/InterfazGraficasAdmin/generar_grafico_HumAmb.php?fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&selected_var=$selected_var&id_disp=$id_disp&ID_USU= $ID_USU");}
                       
                           else if($selected_var == "I_solar"){header("Location: ../../../SPRINT3/InterfazGraficasAdmin/generar_grafico_LuzSolar.php?fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&selected_var=$selected_var&id_disp=$id_disp&ID_USU= $ID_USU");}
                           
                           else if($selected_var == "Precip"){header("Location: ../../../SPRINT3/InterfazGraficasAdmin/generar_grafico_lluvia.php?fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&selected_var=$selected_var&id_disp=$id_disp&ID_USU= $ID_USU");}                       
                   
ob_end_flush();
}
else{
    $sql2 = "SELECT * from Dispositivo where Id='$id_disp'";
    $result2 = $mysqli->query($sql2);
    $contador2 = 0; 
    while($row2 = $result2->fetch_array(MYSQLI_NUM))
    {
        $nombre_disp=$row2[2];
        $contador2++;
    }
?>
    <div class="subtitulo_No_Datos">
  		<label>El dispositivo " <?php echo $nombre_disp?> " no tiene datos registrados entre las fechas: </label></br>
  		<label><?php echo $fecha_ini?> a <?php echo $fecha_fin?></label>           		   		
   	</div>
   	<div class="BarraInferior">             
        <input type="button" class="btn_cancelar" align="right" value="Volver" onClick="location.href='InterfazSeleccionarUsuarioVisualizacion.php'">
    </div>
<?php           		
}
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



