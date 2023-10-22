<?php

include "Autenticacion/SeguridadAgricultor.php";

?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Pagina principal</title> 
    <meta charset="UTF-8">   
    <link href="Agricultor/MenuAgricultor/Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">   
  </head>  
  <body>

    <nav class="Nav" >
      <div class="FondoNav"><img src="Agricultor/MenuAgricultor/img/cesped.jpg"></div> 

      <div class="Logo">
        <p>ProperSeed</p>
      </div>

      <div class="BarraNavegacion">
          <button class="btn">
            <i class="fas fa-user"></i>
            <span>Perfil de Usuario</span> 
          </button>
          <button class="btn">
            <i class="fas fa-tachometer-alt"></i>
            <span>Ultimo registro</span>
          </button>
          <button class="btn">
            <i class="fas fa-calendar-alt"></i>
            <span>Registro entre fechas</span>
          </button>
          <button class="btn">
            <i class="fas fa-chart-bar"></i>
            <span>Analisis estadistico</span>
          </button>
      </div> 
    </nav>

    <section class="Section">
      <div class="Header" align="right" >
        <h2>Agricultor</h2>
        <i class="fas fa-exclamation-circle"></i>
        <i class="fas fa-user-circle"></i>
        <a>Nombre</a>
      </div>

      <div class="Contenedor">
        <!-- AQUI VA EL CODIGO PARA DE LAS DEMAS TAREAS -->
          
          

      </div>
      
    </section>
    <script type="text/javascript" src="Agricultor/MenuAgricultor/Eventos.js"></script>
  </body>  
</html>

