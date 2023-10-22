<?php

// Colocarlo en las paginas del agricultor
                                                 
session_start();
if (isset($_SESSION["autenticado"]))
    {
        if ($_SESSION["autenticado"] != "P5-4ut")
            {
              header('Location: /SPRINT2/InterfazInicioSesion.php');  //Mensaje de que no se ha logueado
            }
        else
            {      
                if ($_SESSION["tipo"] != "Agricultor")
                    header('Location: /SPRINT2/Admin/InterfazGestionUsuarios/InterfazGestionUsuarios.php');   //Enviar a la pagina principal
            }
    }
else
    {
        header('Location: /SPRINT2/InterfazInicioSesion.php');
    }    
?>