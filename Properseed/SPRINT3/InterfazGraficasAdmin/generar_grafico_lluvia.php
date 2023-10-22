<?php
include "../../SPRINT2/Autenticacion/SeguridadAdmin.php"; 
include ("conexion.php");

$selected_var = $_GET["selected_var"];
$fecha_ini = $_GET["fecha_ini"];
$fecha_fin = $_GET["fecha_fin"];
$id_disp = $_GET["id_disp"];
$ID_USU = $_GET["ID_USU"];

$mysqli = new mysqli($host, $user, $pw, $db);

    $sql1 = "SELECT * FROM Parametros WHERE Id_dispositivo = '$id_disp' AND Fecha >= '$fecha_ini' AND Fecha <= '$fecha_fin'";
    $result1 = $mysqli->query($sql1);
    $contador1 = 0;
    $NumN=0;
    $NumS=0;
    while($row1 = $result1->fetch_array(MYSQLI_NUM))
    {
        if($row1[4]==0){
        $NumN++;
        }
        else{
        $NumS++;    
        }
        $contador1++;
    }
    if($contador1>0){
        $PorcN=($NumN/$contador1)*100;
        $PorcS=100-$PorcN;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>HighChart</title>
	<meta charset="UTF-8">   
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">   
  </head>  
<body>
<?php include "../../SPRINT2/Admin/Panel/PanelAdmin.php";?> <!-- Esto carga el panel superior e izquierdo del agricultor -->
<script type="text/javascript">

$(function () { 

    var porcN = <?php echo $PorcN; ?>;
    var porcS = <?php echo $PorcS; ?>;
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d:{   
            enabled: true,
            alpha: 45,
            beta: 0
            }
        },
         tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
   },
        title: {
            text: 'Porcentaje de precipitaciones'
        },
        series: [{
            type:'pie',
            name: 'Precipitaciones',
            data: [['Sí',   porcS],
                ['No', porcN]]
        }]
    });
});

</script>

<div class="contenedor">
	<br/>
	<h2 class="text-center">Porcentaje de precipitaciones entre: <?php echo $fecha_ini?> y <?php echo $fecha_fin?></h2>
    <div class="formulario">
        <div class="contenido">
            <div class="panel panel-default">
                <div class="panel-heading">Gráfica</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
            <form method="POST" action="https://properseedp1.000webhostapp.com/SPRINT2/Admin/InterfazSeleccionVisualizacion/InterfazSeleccionVisualizacionV2_copia.php">
            <div class="BarraBotonMod">                  
                  <input type="hidden" name="enviado" value="S1">  
           		  <input type="hidden" name="ID_DISP" value=<?php echo $id_disp?>>
           		  <input type="hidden" name="ID_USU" value=<?php echo $ID_USU?>>  
           		  <input type="submit" class="btn_form" value="Volver">
            </div>                                          
            </form>
        </div>
    </div>
</div>
    </div>     
    <script type="text/javascript" src="Admin/MenuAgricultor/Eventos.js"></script>
  </body>  
</html>