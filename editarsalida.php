<?php
	include("conex.php");
?>
<?php 
		if (isset($_POST['enviar'])) {
		$norecibo = $_POST['norecibo'];
		$fecha = $_POST['fecha'];
		$codigo = $_POST['codigo'];
		$cantidad = $_POST['cantidad'];
		$folio = $_POST['folio'];
		$recibe = $_POST['recibe'];
		$entrega = $_POST['entrega'];



		$sql = "update salidas set norecibo = '".$norecibo."', fecha = '".$fecha."', codigo = '".$codigo."', cantidad = '".$cantidad."', folio = '".$folio."', recibe = '".$recibe."', entrega = '".$entrega."' where norecibo = '".$norecibo."'";
		$resultado = mysqli_query($conexion,$sql);
		if ($resultado) {
			echo " <script languaje='JavaScript'> alert('Registro actualizado exitosamente');
				location.assign('salidas.php');</script>";
		}else{
			echo "<script languaje='JavaScript'> alert('Fallo al actualizar  el registro');
				location.assign('salidas.php');</script>";
		}
		mysqli_close($conexion);


	}else{
		$norecibo = $_GET['norecibo'];
		$sql = "select * from salidas where norecibo = '".$norecibo."'";
		$resultado = mysqli_query($conexion,$sql);
		$fila = mysqli_fetch_assoc($resultado);
		$norecibo = $fila['norecibo'];
		$fecha = $fila['fecha'];
		$codigo = $fila['codigo'];
		$cantidad = $fila['cantidad'];
		$folio = $fila['folio'];
		$recibe = $fila['recibe'];
		$entrega = $fila['entrega'];



		mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Editar</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">




<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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



	<div class="tamaño fw-bold row col-10 text-center mx-auto rounded position-absolute top-50 start-50 translate-middle">
		<div class="titulo">
			<h2>Actualizar Salida</h2>
		</div><br>
	<form class="text-uppercase row col-12 ms-1" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
		
		<div class="form-group">
			<input type="hidden" name="norecibo" value="<?php echo $norecibo; ?>">
		</div>
		<div class="form-group col-4 p-1">
			<label>Fecha</label>
			<input class="form-control border border-dark" type="date" name="fecha" value="<?php echo $fecha; ?>">
		</div>
		<div class="form-group col-4 p-1">
			<label>Codigo</label>
			<input class="form-control border border-dark" type="text" name="codigo" value="<?php echo $codigo; ?>">
		</div>
		<div class="form-group col-4 p-1">
			<label>Cantidad</label>
			<input class="form-control border border-dark" type="text" name="cantidad" value="<?php echo $cantidad; ?>">
		</div>
		<div class="form-group col-4 p-1">
			<label>Folio</label>
			<input class="form-control border border-dark" type="text" name="folio" value="<?php echo $folio; ?>">
		</div>
		<div class="form-group col-4 p-1">
			<label>Recibe</label>
			<input class="form-control border border-dark" type="text" name="recibe" value="<?php echo $recibe; ?>">
		</div>
		<div class="form-group col-4 p-1">
			<label>Entrega</label>
			<input class="form-control border border-dark" type="text" name="entrega" value="<?php echo $entrega; ?>">
		</div>
		<div class="d-grid gap-2 d-md-flex py-2 justify-content-md-end py-2">
				<button class="btn btn-success" type="submit" name="enviar">Actualizar</button>
				<a class="btn btn-danger float-right" href="salidas.php">Cancelar</a>
		</div>
	</form>
	</div>
	<?php 
		}
	?>
</body>
</html>