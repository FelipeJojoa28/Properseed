<?php 
    echo "
    <nav class=\" Nav \" >
      <div class=\"FondoNav\"><img src=\"img/cesped.jpg\"></div> 

      <div class=\"Logo\">
        <p>ProperSeed</p>
      </div>

      <div class=\"BarraNavegacion\">
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Agricultor/InterfazUltimosRegistros/InterfazSeleccionarDispositivo.php'\">
            <i class=\"fas fa-history\"></i>
            <span>Últimos registros</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='/SPRINT2/Agricultor/InterfazRegistroEntreFechas/InterfazSeleccionarFecha.php'\">
            <i class=\"fas fa-calendar-check\"></i>
            <span>Registro entre fechas</span>
          </button>
      </div> 
      </div> 
    </nav>

    <section class=\"Section\">
      <div class=\"Header\" align=\"right\" >
        <h2>Agricultor</h2>
        <i class=\"fas fa-exclamation-circle\"></i>
        <i class=\"fas fa-user-circle\"></i>
        <a> ";
        echo $_SESSION["nombres"];
        echo " </a>
        <i class=\"fas fa-power-off\" onclick=\"window.location.href='/SPRINT2/Autenticacion/cerrar_sesion.php'\"></i>
      </div>
      
      
    ";
?>