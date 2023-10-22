<?php
// Colocarlo en las paginas del administrador
include "../../Autenticacion/SeguridadAgricultor.php"; 
include "conexion.php";
$mysqli = new mysqli($host, $user, $pw, $db);
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
    
    <?php include "../Panel/PanelAgricultor.php";?> <!-- Esto carga el panel superior e izquierdo del admin -->
    
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
$id=$_SESSION["id"];                    //id del usuario agricultor
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
    $id_disp = $_POST["ID_DISP"];   //id del dispositivo asociado
    $sql1 = "SELECT * from Parametros where Id_dispositivo='$id_disp'";
    $result1 = $mysqli->query($sql1);
    $contador1 = 1; //problemaaaa
    while($row1 = $result1->fetch_array(MYSQLI_NUM))
    {
        $temp = $row1[1];
        $hum_suelo = $row1[2];
        $hum_amb = $row1[3];
        $intensidad_luz = $row1[5];
        $contador1++;
    }//Finaliza el while 
    if($contador1>0){  //al menos 1 dispo 
?>
    
                    <form method="POST" action="Destino.php">
                        <table class="Filtros" width=100%>
                          <tr>
                            <td class="Atributo">                                   
                              <label>Seleccion de variable: </label> 
                                <select class="Select-atributo" name="select" required>
                                    
                                    <option value="Temperatura">Temperatura</option>
                                    <option value="H_suelo">Humedad del suelo</option> 
                                    <option value="H_amb">Humedad del ambiente</option>
                                    <option value="I_solar">Intensidad de luz solar</option>
                                </select>
                             </td>
                             
                            <td class="Atributo"> 
                             <label>Fecha inicio: </label>
           		   		      <input type="date" class="input" name="fecha_ini" required> 
                            </td>
                              
                            <td class="Atributo">
                            <label>Fecha fin: </label>
           		   		      <input type="date" class="input" name="fecha_fin" required>
                            </td>
                           </tr>    
                           <tr class="BarraBotonMod">                  
                            <td>
                            <input type="hidden" name="enviado" value="S1">
                            <input type="hidden" name="id_disp" value =<?php echo $id_disp;?>>
           		            <input type="submit" class="btn_form" value="Consultar">
                            </td>
                           </tr>    
              </table>
            </form>  
<?php
}
}              //Finaliza el if
else{
?>
    <div class="subtitulo_No_Datos">
  		<label>El dispositivo seleccionado no tiene datos registrados</label>           		   		
   	</div>
<?php           		
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
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>



