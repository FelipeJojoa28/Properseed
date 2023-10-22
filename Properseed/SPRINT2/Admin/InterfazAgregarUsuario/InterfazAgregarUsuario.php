<?php
// Colocarlo en las paginas del administrador
    include "conexion.php";                  
    include "../../Autenticacion/SeguridadAdmin.php";
    $mysqli = new mysqli($host, $user, $pw, $db);
    ob_start();
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Agregar Usuario</title> 
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
                <i class="fas fa-user-plus"></i>
              </div>
              <h4 class="Name-titulo">INGRESAR DATOS DE USUARIO NUEVO</h4> <!--Titulo-->
            </div>
            <div class="Contenido">
<?php    
    if ((isset($_POST["enviado"])))
    {
        include "guardar_datos_usuario.php";
    }
    else
    {
        $cedula = "";
        $nombres = "";
        $tipo = "";
        $apellidos = "";
        $usuario = "";
        $contrasena1 = "";  
        ob_end_flush();
    }
?>              
              <form action="InterfazAgregarUsuario.php" method="post"><!-- registro -->
                                  
                  <div class="form-group" style="color:#9E9E9E; font-size:15pt;">                                        
                    <label>Tipo de usuario:</label></br>
                    <select class="listado" name="tipo">
                <?php
                    if ($tipo == "Administrador"){
                ?>   
                        <option data-tokens="Agricultor">Administrador</option>
                        <option data-tokens="Administrador">Agricultor</option>  
                <?php
                    }
                    else
                    {
                ?>
                        <option data-tokens="Agricultor">Agricultor</option>
                        <option data-tokens="Administrador">Administrador</option>  
                <?php
                    }
                ?>
                    </select>                                          
                   </div>
              
                <div class="input-div nombre">           		  
           		   <div class="div">
               		    <h5>Nombre</h5>
               		   	<input type="text" class="input" name="nombre" value="<?php echo $nombres; ?>" required>
           		    </div>
           		</div>
           		
                <div class="input-div apellido">           		   
           		   <div class="div">
           		   		<h5>Apellido</h5>
           		   		<input type="text" class="input" name="apellido" value="<?php echo $apellidos; ?>" required>
           		   </div>
           		</div>

                <div class="input-div cedula">           		   
           		   <div class="div">
           		   		<h5>C&eacutedula</h5>
           		   		<input type="number" class="input" name="cedula" value="<?php echo $cedula; ?>" required>
           		   </div>
                </div> 
                            
                <div class="input-div usuario">           		   
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" class="input" name="usuario" value="<?php echo $usuario; ?>" required>
           		   </div>
                </div>   
                  <div class="input-div pass">
           		     <div class="div">
           		   		  <h5>Contrase&ntilde;a</h5>
           		   		  <input type="password" class="input" name="contrasena" value="<?php echo $contrasena1; ?>" required>
           		     </div>
           		 </div>    
                <div class="BarraInferior">             
                  <input type="hidden" name="enviado" value="S1">  
           		  <input type="submit" class="btn_form" value="Registrar">
              </div>
</form><!-- Cierrra form registro -->
              
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


