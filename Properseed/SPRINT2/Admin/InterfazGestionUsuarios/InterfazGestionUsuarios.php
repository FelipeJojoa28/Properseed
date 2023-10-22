<?php
// Colocarlo en las paginas del administrador
include "conexion.php";                  
include "../../Autenticacion/SeguridadAdmin.php";
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
    
    <?php include "../Panel/PanelAdmin.php";?> <!-- Esto carga el panel superior e izquierdo del admin -->

      <div class="Contenedor">
        <div class="Formulario">
          <div class="Titulo">
            <div class="Cont-icon">
              <i class="fas fa-users-cog"></i>
            </div>
            <h4 class="Name-titulo">Gestión de usuarios</h4> <!--Titulo-->
          </div>

          <div class="Contenido">

            <form method="POST" action="InterfazGestionUsuarios.php">
              <table class="Filtros" width=100%>
                <?php
                   if ((isset($_POST["filtrar"]))){
                     $select = $_POST["select"];
                     $text = $_POST["text"];
                     $filas = $_POST["filas"];

                      ?>
                      <tr>
                      <td class="Atributo">
                      <select class="Select-atributo" name="select">
                      <?php
                      if ($select != "nombre"){  
                        if ($select == "id")
                         {
                          ?>
                          <option value=id>ID</option>
                          <option value=nombre>Nombres</option> 
                          <option value=apellido>Apellidos</option>
                          <option value=cedula>Cedula</option>
                          <?php
                         }
                          else if ($select == "apellido")
                         {
                          ?>
                          <option value=apellido>Apellidos</option>
                          <option value=nombre>Nombres</option>
                          <option value=id>ID</option> 
                          <option value=cedula>Cedula</option>
                          <?php
                         }
                          else if ($select == "cedula")
                         { 
                          ?>
                          <option value=cedula>Cedula</option>
                          <option value=nombre>Nombres</option>
                          <option value=id>ID</option> 
                          <option value=apellido>Apellidos</option>
                          <?php
                         }
                      }else{
                        ?>
                        <option value=nombre>Nombres</option>
                        <option value=id>ID</option> 
                        <option value=apellido>Apellidos</option>
                        <option value=cedula>Cedula</option>
                        <?php
                      }
                      ?>
                      </select>
                      <?php

                      if ($text != ""){
                        ?>
                        <input class="Text-atributo" type="text" name=text value=<?php echo $text; ?>>
                        <?php
                      }else{
                        ?>
                        <input class="Text-atributo" type="text" name=text value="">
                        <?php
                      }

                      ?>
                        <button class="Btn-filas" type="submit"><i class="fas fa-search"></i></button>
                      </td>
                      <td class="Filas" align=right>
                        <font class="Text-filas">Numero filas: </font>
                      <?php
                        if ($filas != ""){
                          ?>
                          <input class="Number-filas" type="number" name="filas" min="1" value=<?php echo $filas; ?> required>
                          <?php
                        }else{
                          ?>
                          $filas = "10";
                          <input class="Number-filas" type="number" name="filas" min="1" value=<?php echo $filas;?> required>
                          <?php
                        }
                      ?>
                        <button class="Btn-filas" type="submit"><i class="fas fa-search"></i></button>
                      </td>
                      </tr>

                      <?php
                    }else
                    {
                ?> 
                      <tr>
                        <td class="Atributo">
                          <select class="Select-atributo" name="select">
                            <option value=nombre>Nombres</option>
                            <option value=id>ID</option> 
                            <option value=apellido>Apellidos</option>
                            <option value=cedula>Cedula</option>
                          </select>
                          <input class="Text-atributo" type="text" name=text value="">
                          <button class="Btn-filas" type="submit"><i class="fas fa-search"></i></button>
                        </td>
                        <td class="Filas" align=right>
                          <font class="Text-filas">Numero filas:</font>
                          <?php $filas = "10"; ?>
                          <input class="Number-filas" type="number" name="filas" min="1" value=<?php echo $filas;?> required>
                          <button class="Btn-filas" type="submit"><i class="fas fa-search"></i></button>
                        </td>
                      </tr>
                <?php
                    }
                ?>
              </table>
              <input type="hidden" value="1" name="filtrar">
            </form>

            <table class="Tabla_usuarios">
              <thead>
                <tr>
                  <td style="text-align: center;">ID</td>
                  <td>Nombre</td>
                  <td>Apellido</td>
                  <td>Cédula</td>
                  <td style="text-align: right;">Tipo de usuario</td>
                  <td style="text-align: right;">Acciones</td>
                </tr>
              </thead>
              <tbody>
              <?php

              if ((isset($_POST["filtrar"]))){

                if ($text != ""){
                  if ($select == "nombre"){
                    $sql1 = "SELECT * from Usuario where Nombres LIKE '$text%' order by Nombres LIMIT $filas";
                  }else if ($select == "id"){
                    $sql1 = "SELECT * from Usuario where ID='$text' order by Nombres LIMIT $filas";
                  }else if ($select == "apellido"){
                    $sql1 = "SELECT * from Usuario where Apellidos LIKE '$text%' order by Nombres LIMIT $filas";
                  }else{
                    $sql1 = "SELECT * from Usuario where Cedula LIKE '$text%' order by Nombres LIMIT $filas";
                  }
                }else{
                  $sql1 = "SELECT * from Usuario order by Nombres LIMIT $filas";
                }
              }else{
                $sql1 = "SELECT * from Usuario order by Nombres LIMIT $filas";
              }

                $result1 = $mysqli->query($sql1);
                $contador1 = 0;
                while($row1 = $result1->fetch_array(MYSQLI_NUM))
                {   
                    $id = $row1[0];
                    $tipo = $row1[1];                          
                    $nombre = $row1[3];                           
                    $apellido = $row1[2];
                    $cedula = $row1[4];
                    $estado = $row1[7];
                    $contador1++;

                    if ($estado == 0) {
                      ?>
                      <tr style="background-color: rgba(255, 50, 50, 0.15);">
                      <?php
                    }else{
                      ?>
                      <tr>
                      <?php
                    }
              ?>
                      <td style="text-align: center;" value=<?php echo $id;?>><?php echo $id;?></td>
                      <td><?php echo $nombre;?></td>
                      <td><?php echo $apellido;?></td>
                      <td><?php echo $cedula;?></td>
                      <td style="text-align: right;"><?php echo $tipo;?></td>
                      <td style="text-align: right;">
                        <button class="btn_tabla_consultar" value="Consultar usuario" title="Consultar usuario">
                          <i class="fas fa-user"></i>
                        </button>
                        <button class="btn_tabla_modificar" value="Modificar usuario" title="Modificar usuario">
                          <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn_tabla_eliminar" value="Eliminar usuario" title="Eliminar usuario">
                          <i class="fas fa-times"></i>
                        </button>
                      </td>                                                      
                    </tr>                                                                           
                <?php
                }              //Finaliza el while 
                ?>
                </tbody>              
            </table>

            <form id="formulario_consultar_usuario" method="POST" action="/SPRINT2/Admin/InterfazConsultarUsuario/InterfazConsultarUsuario.php">
              <input id="id_consultar_usuario" value="" type="hidden" name="id">
              <input type="hidden" value="1" name="ConsultarUsuario">
            </form>

            <form id="formulario_modificar_usuario" method="POST" action="modificar_usuario.php">
              <input id="id_modificar_usuario" value="" type="hidden" name="ModificarUsuario">
            </form>

          </div>          
        </div>
      </div>
    </section>
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>



