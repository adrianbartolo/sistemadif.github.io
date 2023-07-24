<?php 

	include("conex.php");

	$sql = "SELECT * FROM entradas";
	$resultado = mysqli_query($conexion,$sql);
?>

<?php 
	if (isset($_POST['enviar'])) {
		$nofactura = $_POST['nofactura'];
		$proveedor = $_POST['proveedor'];
		$fecha = $_POST['fecha'];
		$codigo = $_POST['codigo'];
		$cantidad = $_POST['cantidad'];
		$folio = $_POST['folio'];
		$recibe = $_POST['recibe'];
		$entrega = $_POST['entrega'];
		
		$sql = " INSERT INTO entradas (nofactura, proveedor, fecha, codigo, cantidad, folio, recibe, entrega) values ('".$nofactura."','".$proveedor."', '".$fecha."', '".$codigo."', '".$cantidad."', '".$folio."', '".$recibe."','".$entrega."') ";
			$resultado = mysqli_query($conexion, $sql);
			if ($resultado) {
				echo " <script languaje='JavaScript'> alert('Registro realizado exitosamente');
				location.assign('entradas.php');</script>";
			}else{
				echo "<script languaje='JavaScript'> alert('El registro no se realizo exitosamente');
				location.assign('entradas.php');</script>";
			}
			mysql_close($conexion);
	}else{
?>
<html>
<head>
<title>Index</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">


<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
		$(document).on('click', '#btn-modal', function(){
			$('#entrada').modal({
				backdrop:'static',
				keyborad:false
			})
			$('#entrada').modal('show');
		})
	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg color">
 		 <div class="container-fluid">
   			<a class="navbar-brand me-5" href="">
      			<img src="img/sinfondo.png" alt="" width="200" height="50" class="d-inline-block align-text-center">
    		</a>
    
   			
   			 			   			   			   			
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      	 <li class="nav-item">
    	    <a class="navbar-brand d-inline-block align-text-center me-5" href="index.html">INICIO</a>
        </li>

        <li class="nav-item">
    	    <a class="navbar-brand d-inline-block align-text-center me-5" href="inventario.php">INVENTARIO</a>
        </li>
        <li class="nav-item">
	        <a class="navbar-brand d-inline-block align-text-center me-5" href="entradas.php">ENTRADAS</a>
        </li>
        <li class="nav-item">
	        <a class="navbar-brand d-inline-block align-text-center me-5" href="salidas.php">SALIDAS</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<br>
<a class="btn btn-success mb-2" type="submit" id="btn-modal" data-toggle="modal" data-target="#entrada">Nueva Entrada</a>
<br>
<table class="table table-bordered" id="tabla">
	<thead>
		<tr>
			<th>N° Factura</th>
			<th>Proveedor</th>
			<th>Fecha</th>
			<th>Codigo</th>
			<th>Cantidad</th>
			<th>Folio</th>
			<th>Recibe</th>
			<th>Entrega</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			while($fila = mysqli_fetch_assoc($resultado)){
		?>
		<tr>
			<td> <?php echo $fila['nofactura']; ?></td>
			<td><?php echo $fila['proveedor']; ?></td>
			<td><?php echo $fila['fecha']; ?></td>
			<td><?php echo $fila['codigo']; ?></td>
			<td><?php echo $fila['cantidad']; ?></td>
			<td> <?php echo $fila['folio']; ?></td>
			<td> <?php echo $fila['recibe']; ?></td>
			<td> <?php echo $fila['entrega']; ?></td>
			<td>
				<a class="btn btn-primary" href=<?php echo "editarentrada.php?nofactura=".$fila['nofactura'].""; ?>>Editar</a>
				<a class="btn btn-danger" href=<?php echo "eliminarentrada.php?nofactura=".$fila['nofactura'].""; ?> onclick='return confirmar()'>Eliminar</a>
				<a class="btn btn-success" href=<?php echo "pdf.php?nofactura=".$fila['nofactura'].""; ?>>PDF</a>
				
			</td>
		</tr>
			<?php
			}
		?>
		</tbody>
</table>



<?php 
	mysqli_close($conexion);
?>
<?php 
	}
?>


<div class="modal fade fw-bold text-center" id="entrada">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content tamaño py-2">
        <h5 class="modal-title text-center">REGISTRO DE ENTRADAS</h5>
      <div class="modal-body">
      	<form class="row text-uppercase" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
					<div class="form-group col-5 p-1">
						<label>N° Factura</label>
						<input class="form-control border border-dark" type="text" name="nofactura" required>
					</div>
					<div class="form-group col-4 p-1">
						<label>Fecha</label>
						<input class="form-control border border-dark" type="date" name="fecha" required>
					</div>
					<div class="form-group col-3 p-1">
						<label>Cantidad</label>
						<input class="form-control border border-dark" type="text" name="cantidad" required>
					</div>
					<div class="form-group col-6 p-1">
						<label>Codigo</label>
						<input class="form-control border border-dark" type="text" name="codigo" required>
					</div>
					<div class="form-group col-6 p-1">
						<label>Folio</label>
						<input class="form-control border border-dark" type="text" name="folio" required>
					</div>
					<div class="form-group col-12 p-1">
						<label>Proveedor</label>
						<input class="form-control border border-dark" type="text" name="proveedor" required>
					</div>
					<div class="form-group col-6 p-1">
						<label>Recibe</label>
						<input class="form-control border border-dark" type="text" name="recibe" required>
					</div>
					<div class="form-group col-6 p-1">
						<label>Entrega</label>
						<input class="form-control border border-dark" type="text" name="entrega" required>
					</div>
					<br>
					<div class="d-grid gap-2 py-2 d-md-flex justify-content-md-end">
							<button class="btn btn-success" type="submit" name="enviar">Registrar</button>
							<a class="btn btn-danger float-right" href="entradas.php">Cancelar</a>
					</div>
				</form>
      </div>
    </div>
  </div>
</div>


<script>
        $(document).ready(function() {
        $('#tabla').DataTable( {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json'
            }
        } );
    } );
    </script>
    <script type="text/javascript">
    	function confirmar() {
    		return confirm('Realmente desea eliminar el registro?');
    	}
    </script>
</body>
</html>