<?php 
ob_start()
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PDF</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>

<?php 
 include("conex.php");
 
	if (isset($_POST['enviar'])) {
		$nofactura = $_POST['nofactura'];
		$proveedor = $_POST['proveedor'];
		$fecha = $_POST['fecha'];
		$codigo = $_POST['codigo'];
		$cantidad = $_POST['cantidad'];
		$folio = $_POST['folio'];
		$recibe = $_POST['recibe'];
		$entrega = $_POST['entrega'];



		$sql = "update entradas set nofactura = '".$nofactura."', proveedor = '".$proveedor."', fecha = '".$fecha."', codigo = '".$codigo."', cantidad = '".$cantidad."', folio = '".$folio."', recibe = '".$recibe."', entrega = '".$entrega."' where nofactura = '".$nofactura."'";
		$resultado = mysqli_query($conexion,$sql);
		if ($resultado) {
			echo " <script languaje='JavaScript'> alert('Registro actualizado exitosamente');
				location.assign('index.php');</script>";
		}else{
			echo "<script languaje='JavaScript'> alert('Fallo al actualizar el exitosamente');
				location.assign('index.php');</script>";
		}
		mysqli_close($conexion);


	}else{
		$nofactura = $_GET['nofactura'];
		$sql = "select * from entradas where nofactura = '".$nofactura."'";
		$resultado = mysqli_query($conexion,$sql);
		$fila = mysqli_fetch_assoc($resultado);
		$nofactura = $fila['nofactura'];
		$proveedor = $fila['proveedor'];
		$fecha = $fila['fecha'];
		$codigo = $fila['codigo'];
		$cantidad = $fila['cantidad'];
		$folio = $fila['folio'];
		$recibe = $fila['recibe'];
		$entrega = $fila['entrega'];



		mysqli_close($conexion);
?>
<?php
$dif = "img/color.jpg";
$imagenBase64 = "data:image/jpg;base64," . base64_encode(file_get_contents($dif));
?>
	<form class="text-uppercase" action="<?=$_SERVER['PHP_SELF']?>" method="GET">		
		


		<div class="position-absolute top-0 start-0">
			<label class="fw-bold">Folio:</label>
			<label><?php echo $folio; ?></label> 
		</div>
		

		<div class="position-absolute top-0 end-0">
			<label class="fw-bold">Fecha:</label>	
			<label><?php echo $fecha; ?></label>
		</div>
		<br><br><br><br>

		<table class="table table-bordered" id="tabla">
	<thead>
		<tr>
			<th>Proveedor</th>
			<th>No de Factura</th>
			<th>Cantidad</th>
			<th>Codigo</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> <?php echo $proveedor; ?></td>
			<td><?php echo $nofactura; ?></td>
			<td><?php echo $cantidad; ?></td>
			<td><?php echo $codigo; ?></td>
		</tr>
		</tbody>
	</table>

		<img src="<?php echo $imagenBase64 ?>" width="725" height="700"/>


		<div class="position-absolute bottom-0 start-0">
			<label class="fw-bold">Entrega</label><br>
			<label><?php echo $entrega; ?></label>
		</div><br>
		<div class="position-absolute bottom-0 end-0">
			<label class="fw-bold">Recibe</label><br>
			<label><?php echo $recibe; ?></label>
		</div>
	</form>

		

<?php 
}
?>

<script>
        $(document).ready(function() {
        $('#tabla').DataTable( {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json'
            }
        } );
    } );
    </script>
</body>
</html>
<?php
$html=ob_get_clean();

require_once 'libreria/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();


//True para descargar el pdf sin abrir en el navegador
$dompdf->stream("Reporte.pdf", array("Attachment"=>false));
?>