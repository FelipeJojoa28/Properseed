<?php
    session_start();
    if (isset($_SESSION["autenticado"]))
    {
        if ($_SESSION["autenticado"] == "P5-4ut")
        {      
            if ($_SESSION["tipo"] != "Administrador")
            {
                header("Location: /SPRINT2/Agricultor/InterfazRegistroEntreFechas/InterfazSeleccionarFecha.php");   // Enviar a la pagina principal
            }
            else
            {
                header('Location: /SPRINT2/Admin/InterfazGestionUsuarios/InterfazGestionUsuarios.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesión</title>
	<link rel="stylesheet" type="text/css" href="InterfazInicioSesion/Estilo.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="img">
      <img src="InterfazInicioSesion/img/Fondo.jpg">
    </div>
	<div class="container">
		<div class="login-content">
			<form method="POST" action="Autenticacion/validar.php">
        <h2 class="title">Bienvenido</h2>
				<img src="InterfazInicioSesion/img/avatar.svg">
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" class="input" name="login" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input type="password" class="input" name="passwd" required>
            	   </div>
            	</div>
            	<a href="#">¿Recordar contraseña?</a>

				<?php
                if (isset($_GET["mensaje"]))
                 {
                 $mensaje = $_GET["mensaje"];
                    if ($_GET["mensaje"]!=""){
                ?>
				  
					<div class="Mensaje" style="color:red; padding-top: 15px; font-size: 0.9rem;">
						<span>
						<?php 
						if ($mensaje == 1)
							echo "El password del usuario no coincide.";
						if ($mensaje == 2)
							echo "No hay usuarios con el login(usuario) ingresado o está inactivo.";
						if ($mensaje == 3)
							echo "No se ha logueado en el Sistema. Por favor ingrese los datos.";
						if ($mensaje == 4)
							echo "Su tipo de usuario, no tiene las credenciales suficientes para ingresar a esta opción.";
						?>
						</span>                         
					</div>
                <?php 
                   }
                 }
                ?>

            	<input type="submit" class="btn" value="Iniciar">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="InterfazInicioSesion/Eventos.js"></script>
</body>
</html>
