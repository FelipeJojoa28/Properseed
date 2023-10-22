<?php
include "../../SPRINT2/Autenticacion/SeguridadAgricultor.php"; 
include ("conexion.php");

$selected_var = $_GET["selected_var"];
$fecha_ini = $_GET["fecha_ini"];
$fecha_fin = $_GET["fecha_fin"];
$id_disp = $_GET["id_disp"];

$mysqli = new mysqli($host, $user, $pw, $db);

    $sql = "SELECT TRUNCATE(AVG(Intensidad_luz_solar),2) as LUZ_PRO FROM Parametros WHERE Id_dispositivo = '$id_disp' AND Fecha >= '$fecha_ini' AND Fecha <= '$fecha_fin' GROUP BY HOUR(Hora) ORDER BY Hora";
	$luz = mysqli_query($mysqli,$sql);
	$luz = mysqli_fetch_all($luz,MYSQLI_ASSOC);
	$luz = json_encode(array_column($luz, 'LUZ_PRO'),JSON_NUMERIC_CHECK);
    $sql2 = "SELECT HOUR(Hora) as EjeX FROM Parametros WHERE Id_dispositivo = '$id_disp' AND Fecha >= '$fecha_ini' AND Fecha <= '$fecha_fin' GROUP BY HOUR(Hora) ORDER BY Hora";
	$ejex = mysqli_query($mysqli,$sql2);
	$ejex = mysqli_fetch_all($ejex,MYSQLI_ASSOC);
	$ejex = json_encode(array_column($ejex, 'EjeX'),JSON_NUMERIC_CHECK);
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
<?php include "../../SPRINT2/Agricultor/Panel/PanelAgricultor.php";?> <!-- Esto carga el panel superior e izquierdo del agricultor -->
<script type="text/javascript">

$(function () { 

    var data_luz = <?php echo $luz; ?>;
    var data_ejex = <?php echo $ejex; ?>;
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Intensidad de luz solar por hora'
        },
        xAxis: {
            title: {
                text: 'Hora'
            },
            categories: data_ejex//['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23']
        },
        yAxis: {
            title: {
                text: 'Intensidad de luz solar (%)'
            }
        },
        series: [{
            name: 'Intensidad de luz solar',
            data: data_luz
        }]
    });
});

</script>

<div class="contenedor">
	<br/>
	<h2 class="text-center">Promedios de intensidad de luz solar</h2>
    <div class="formulario">
        <div class="contenido">
            <div class="panel panel-default">
                <div class="panel-heading">Gráfica</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
            <form method="POST" action="https://properseedp1.000webhostapp.com/SPRINT2/Agricultor/InterfazSeleccionVisualizacion/InterfazSeleccionarDispositivo.php">
            <div class="BarraBotonMod">                  
                  <input type="hidden" name="enviado" value="S1">  
           		  <input type="hidden" name="ID_DISP" value=<?php echo $id_disp?>>  
           		  <input type="submit" class="btn_form" value="Volver">
            </div>                                          
            </form>
        </div>
    </div>
</div>

</body>
</html>      