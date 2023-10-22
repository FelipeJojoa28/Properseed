<?php
// Colocarlo en las paginas del administrador
include "conexion.php";
include "../../Autenticacion/SeguridadAdmin.php";
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Modificar Usuario</title> 
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
              <h4 class="Name-titulo">MODIFICAR DATOS DE USUARIO</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
            <?php
if ((isset($_POST["enviado"])))
   {
   $enviado = $_POST["enviado"];
   if ($enviado == "S1")
    {
       $ID_USU = $_POST["ID_USU"];                
$sql1 = "SELECT * from Usuario where id=$ID_USU";
$result1 = $mysqli->query($sql1);
$contador = 0;
while($row1 = $result1->fetch_array(MYSQLI_NUM))
{
 $tipo = $row1[1];
 $nombre = $row1[3];                
 $apellido = $row1[2];
 $cedula = $row1[4];
 $usuario = $row1[5];
 $contrasena = $row1[6];
 $activo = $row1[7];
 $contador++;                                                                                                     
}
?>
              <form action="guardar_cambios_usuario.php" method="post"><!-- registro -->
                                  
                  <div class="form-group" style="color:#9E9E9E; font-size:15pt;">                                        
                    <label>Tipo de usuario:</label></br>
                    <select class="listado" name="tipo">
                        <?php
                            if($tipo=="Agricultor"){?>
                                <option data-tokens="Agricultor" selected>Agricultor</option>
                                <option data-tokens="Administrador">Administrador</option>      
                            <?php
                            }
                            else{?>
                                <option data-tokens="Agricultor">Agricultor</option>
                                <option data-tokens="Administrador" selected>Administrador</option>      
                            <?php
                            }
                        ?>
                    
                    </select>                                          
                   </div>
              
                <div class="input-div nombre">           		   
           		   <div class="div">
           		   		<h5>Nombre</h5>
           		   		<input type="text" class="input" name="nombre" required value=<?php echo $nombre;?>>
           		   </div>
           		  </div>                                            
                <div class="input-div apellido">           		   
           		   <div class="div">
           		   		<h5>Apellido</h5>
           		   		<input type="text" class="input" name="apellido" required value=<?php echo $apellido;?>>
           		   </div>
           		</div>

                <div class="input-div cedula">           		   
           		   <div class="div">
           		   		<h5>C&eacutedula</h5>
           		   		<input type="number" class="input" name="cedula" required value=<?php echo $cedula;?>>
           		   </div>
                </div> 
                            
                <div class="input-div usuario">           		   
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" class="input" name="usuario" required value=<?php echo $usuario;?>>
           		   </div>
                </div>   
                  <div class="input-div pass">
           		     <div class="div">
           		   		  <h5>Contrase&ntilde;a</h5>
           		   		  <input type="password" class="input" name="contrasena">
           		     </div>
           		 </div>    
                 <div class="form-group" style="color:#9E9E9E; font-size:15pt;">                                        
                    <label>Estado:</label></br>
                    <select class="listado" name="activo">
                    <?php
                            if($activo==1){?>
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>      
                            <?php
                            }
                            else{?>
                                <option value="1">Activo</option>
                                <option value="0" selected>Inactivo</option>      
                            <?php
                            }
                        ?>
                    
                    
                    </select>                                          
                   </div>
                <div class="BarraInferior">             
                  <input type="hidden" name="enviado" value="S1">
                  <input type="hidden" name="ID_USU" value=<?php echo $ID_USU;?>>  
           		  <input type="submit" class="btn_guardar" value="Guardar Cambios">
                  <input type="button" class="btn_cancelar" align="right" value="Cancelar" onClick="location.href='InterfazBuscarUsuario.php'">
              </div>
</form><!-- Cierrra form registro -->
<?php 
}
}
else{
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){
             $ID_USU = $_GET["ID_USU"];                
$sql1 = "SELECT * from Usuario where id=$ID_USU";
$result1 = $mysqli->query($sql1);
$contador = 0;
while($row1 = $result1->fetch_array(MYSQLI_NUM))
{
 $tipo = $row1[1];
 $nombre = $row1[3];
 $apellido = $row1[2];
 $cedula = $row1[4];
 $usuario = $row1[5];
 $contrasena = $row1[6];
 $contador++;                                                                                                     
}
?>
              <form action="guardar_cambios_usuario.php" method="post"><!-- registro -->
                        
                <div class="Mensaje" style="color:red; padding-bottom: 15px; font-size: 0.9rem;">
						<span>
						<?php 
						if ($mensaje == 5)
							echo "El nombre de usuario ingresado ya existe.";
						if ($mensaje == 6)
							echo "La cédula ingresada ya existe.";
						?>
						</span>                         
					</div>                  
                  <div class="form-group" style="color:#9E9E9E; font-size:15pt;">                                        
                    <label>Tipo de usuario:</label></br>
                    <select class="listado" name="tipo">
                    <option data-tokens="Agricultor">Agricultor</option>
                    <option data-tokens="Administrador">Administrador</option>      
                    </select>                                          
                   </div>
              
                <div class="input-div nombre">           		   
           		   <div class="div">
           		   		<h5>Nombre</h5>
           		   		<input type="text" class="input" name="nombre" required value=<?php echo $nombre;?>>
           		   </div>
           		  </div>                                            
                <div class="input-div apellido">           		   
           		   <div class="div">
           		   		<h5>Apellido</h5>
           		   		<input type="text" class="input" name="apellido" required value=<?php echo $apellido;?>>
           		   </div>
           		</div>

                <div class="input-div cedula">           		   
           		   <div class="div">
           		   		<h5>C&eacutedula</h5>
           		   		<input type="number" class="input" name="cedula" required value=<?php echo $cedula;?>>
           		   </div>
                </div> 
                            
                <div class="input-div usuario">           		   
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" class="input" name="usuario" required value=<?php echo $usuario;?>>
           		   </div>
                </div>   
                  <div class="input-div pass">
           		     <div class="div">
           		   		  <h5>Contrase&ntilde;a</h5>
           		   		  <input type="text" class="input" name="contrasena">
           		     </div>
           		 </div>    
                 <div class="form-group" style="color:#9E9E9E; font-size:15pt;">                                        
                    <label>Estado:</label></br>
                    <select class="listado" name="activo">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>      
                    </select>                                          
                   </div>
                <div class="BarraInferior">             
                  <input type="hidden" name="enviado" value="S1">
                  <input type="hidden" name="ID_USU" value=<?php echo $ID_USU;?>>  
           		  <input type="submit" class="btn_guardar" value="Guardar Cambios">
                  <input type="button" class="btn_cancelar" align="right" value="Cancelar" onClick="location.href='InterfazBuscarUsuario.php'">
              </div>
</form>
<?php
       }     
       }
       }
            ?>
              
              <!--div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-list2"></span>Menú</a>
		</div-->                           
          </div>          

        </div>
      </div>
    </section>
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>



