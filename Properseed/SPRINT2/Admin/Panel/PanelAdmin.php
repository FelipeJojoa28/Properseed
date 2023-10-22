<?php 
    echo "
    <nav class=\" Nav \" >
      <div class=\"FondoNav\"><img src=\"img/cesped.jpg\"></div> 

      <div class=\"Logo\">
        <p>ProperSeed</p>
      </div>

      <div class=\"BarraNavegacion\">
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazAgregarUsuario/InterfazAgregarUsuario.php'\">
            <i class=\"fas fa-user-plus\"></i>
            <span>Agregar usuario</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazModificarUsuario/InterfazBuscarUsuario.php'\">
            <i class=\"fas fa-user-edit\"></i>
            <span>Modificar usuario</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazAgregarDispositivo/InterfazAgregarDispositivo.php'\">
            <i class=\"fas fa-microchip\"></i>
            <span>Agregar dispositivo</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazModificarDispositivo/InterfazSeleccionarUsuario.php'\">
            <i class=\"fas fa-edit\"></i>
            <span>Modificar dipositivo</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazUltimosRegistros/InterfazSeleccionarUsuario_fechas.php'\">
            <i class=\"fas fa-tachometer-alt\"></i>
            <span>Último registro</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazRegistroEntreFechas/InterfazSeleccionarUsuario_fechas.php'\">
            <i class=\"fas fa-calendar-alt\"></i>
            <span>Registro entre fechas</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazSeleccionVisualizacion/InterfazSeleccionarUsuarioVisualizacion.php'\">
            <i class=\"fas fa-chart-line\"></i>
            <span>Estadísticas</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazGestionUsuarios/InterfazGestionUsuarios.php'\">
            <i class=\"fas fa-cog\"></i>
            <span>Gestión usuarios</span>
          </button>
      </div> 
      </div> 
    </nav>

    <section class=\"Section\">
      <div class=\"Header\" align=\"right\" >
        <h2>Administrador</h2>
        <a> ";
        echo $_SESSION["nombres"];
        echo " </a>
        <i class=\"fas fa-user-circle\" title=\"Perfil de Usuario\" onclick=\"window.location.href='/SPRINT2/Admin/InterfazPerfilAdmin/InterfazConsultarUsuario.php'\"></i>
        <i class=\"fas fa-power-off\" title=\"Cerrar Sesión\" onclick=\"window.location.href='/SPRINT2/Autenticacion/cerrar_sesion.php'\"></i>
      </div>
      
      
    ";
?>