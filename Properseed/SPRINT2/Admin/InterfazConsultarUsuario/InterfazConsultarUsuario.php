<?php
// Colocarlo en las paginas del administrador
include "conexion.php";                  
include "../../Autenticacion/SeguridadAdmin.php";
$mysqli = new mysqli($host, $user, $pw, $db);
?>
<!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Consultar Usuario</title> 
    <meta charset="UTF-8">                                                      
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script> 
	<meta name="viewport" content="width=device-width, initial-scale=1">   
  </head>  
  <body>
    
    <?php include "../Panel/PanelAdmin.php";?> <!-- Esto carga el panel superior e izquierdo del admin -->

      <div class="Contenedor">

        <div class="Lista-dispositivos">
          <div class="Titulo">
            <div class="Cont-icon">
              <i class="fas fa-list-alt"></i>
            </div>
            <h4 class="Name-titulo">Dispositivos asociados</h4> <!--Titulo-->
          </div>

          <div class="Contenido">
            
            <table class="Tabla_dispositivos">
                <thead>
                  <tr>
                    <td style="text-align: center;">ID</td>
                    <td>Nombre</td>
                    <td>Latitud</td>
                    <td>Longitud</td>
                    <td style="text-align: right;">Acciones</td>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if ((isset($_POST["ConsultarUsuario"]))){
                    $id_usu = $_POST["id"];
                    $sql1 = "SELECT * from Dispositivo where Id_usuario='$id_usu'";
                  }
                  // else{
                    //$sql1 = "SELECT * from dispositivo";
                  //}
                  
                  $result1 = $mysqli->query($sql1);
                  $contador1 = 0;
                  while($row1 = $result1->fetch_array(MYSQLI_NUM))
                  {   
                      $id = $row1[0];
                      $estado = $row1[1];
                      $nombre = $row1[2];                           
                      $latitud = $row1[3];
                      $longitud = $row1[4];
                      $contador1++;
                      
                    if ($estado == 'Inactivo') {
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
                        <td><?php echo $latitud;?></td>
                        <td><?php echo $longitud;?></td>
                        <td style="text-align: right;">
                        <button class="btn_tabla_consultar" value="Consultar usuario" title="Consultar usuario">
                          <i class="fas fa-chart-bar"></i>
                        </button>
                        <button class="btn_tabla_modificar" value="Modificar usuario" title="Modificar usuario">
                          <i class="fas fa-pen"></i>
                        </button>
                      </td>                                                      
                      </tr>                                                                           
                  <?php
                  }              //Finaliza el while 
                  ?>
                  </tbody>              
              </table>

          </div>          
        </div>

        <div class="Perfil">
          <div class="Titulo">
              <div class="Cont-icon">
                <i class="fas fa-address-card"></i>
              </div>
              <h4 class="Name-titulo">Perfil</h4> <!--Titulo-->
            </div>

          <div class="Contenido">
            
            <?php
                $sql1 = "SELECT * from Usuario where Id='$id_usu'";
                $result1 = $mysqli->query($sql1);
                while($row1 = $result1->fetch_array(MYSQLI_NUM)){
                    $id = $row1[0];
                    $tipo = $row1[1];
                    $apellido = $row1[2];
                    $nombre = $row1[3];                           
                    $cedula = $row1[4];
                    $usuario = $row1[5];
                    $estado = $row1[7];
                }
            ?>
              
            <div class="Fondo">
                <img src="img/Fondo_perfil.png" width=100%>
            </div>

            <div class="Avatar">
              <img src="img/avatar.svg" width=100%>
            </div>
            
            <h4 class="Nombre"><?php echo $nombre." ".$apellido;?></h5>

            <table class="Informacion">
                
              <tr class="Row" >
                <td><font class="Titulo">ID: </font></td>
                <td><font class="Descripcion"> <?php echo $id;?> </font></td>
              </tr>
              <tr class="Row">
                <td><font class="Titulo">NOMBRE USUARIO: </font></td>
                <td><font class="Descripcion"> <?php echo $usuario;?> </font></td>
              </tr>
              <tr class="Row">
                <td><font class="Titulo">CEDULA: </font></td>
                <td><font class="Descripcion"> <?php echo $cedula;?>  </font></td>
              </tr>
              <tr class="Row">
                <td><font class="Titulo">TIPO USUARIO: </font></td>
                <td><font class="Descripcion"> <?php echo $tipo;?>  </font></td>
              </tr>
              <tr class="Row">
                <td><font class="Titulo">ESTADO: </font></td>
                <td><font class="Descripcion"> 
                <?php 
                if($estado == 1){
                    echo "Activo";
                }else{
                    echo "Inactivo";
                }?>
                </font></td>
              </tr>
            </table>

            <table class="Dispositivos" align=center>
              <tr class="Row" align=center>
                <td><font class="Titulo">Dispositivos </font></td>
                <td><font class="Titulo"> Activos </font></td>
                <td><font class="Titulo">Inactivos </font></td>
              </tr>
              <?php 
                $sql1 = "SELECT count(*) FROM Dispositivo WHERE Id_usuario='$id_usu'";
                $result1 = $mysqli->query($sql1);
                $row1 = $result1->fetch_array(MYSQLI_NUM);
                $dispositivos = $row1[0];
                $sql1 = "SELECT count(*) FROM Dispositivo WHERE Id_usuario='$id_usu' AND Estado='Activo'";
                $result1 = $mysqli->query($sql1);
                $row1 = $result1->fetch_array(MYSQLI_NUM);
                $activos = $row1[0];
                $sql1 = "SELECT count(*) FROM Dispositivo WHERE Id_usuario='$id_usu' AND Estado='Inactivo'";
                $result1 = $mysqli->query($sql1);
                $row1 = $result1->fetch_array(MYSQLI_NUM);
                $inactivos = $row1[0];
              ?>
              <tr class="Row" align=center>
                <td><font class="Numero"> <?php echo $dispositivos;?> </font></td>
                <td><font class="Numero"> <?php echo $activos;?> </font></td>
                <td><font class="Numero"> <?php echo $inactivos;?> </font></td>
              </tr>
            </table>

          </div>    
        </div>

        
      </div>
    </section>
    <script type="text/javascript" src="Eventos.js"></script>
  </body>  
</html>



