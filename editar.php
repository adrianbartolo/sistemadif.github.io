<?php
	include("conex.php");
?>
<?php 
	if (isset($_POST['enviar'])) {
		$codigo = $_POST['codigo'];
		$descripcion = $_POST['descripcion'];
		$stock = $_POST['stock'];
		$entradas = $_POST['entradas'];
		$salidas = $_POST['salidas'];

		$sql = "update inventario set codigo = '".$codigo."', descripcion = '".$descripcion."', stock = '".$stock."', salidas = '".$salidas."', entradas = '".$entradas."' where codigo = '".$codigo."'";
		$resultado = mysqli_query($conexion,$sql);
		if ($resultado) {
			echo " <script languaje='JavaScript'> alert('Registro actualizado exitosamente');
				location.assign('inventario.php');</script>";
		}else{
			echo "<script languaje='JavaScript'> alert('Fallo al actualizar el registro');
				location.assign('inventario.php');</script>";
		}
		mysqli_close($conexion);


	}else{
		$codigo = $_GET['codigo'];
		$sql = "select * from inventario where codigo = '".$codigo."'";
		$resultado = mysqli_query($conexion,$sql);
		$fila = mysqli_fetch_assoc($resultado);
		$codigo = $fila["codigo"];
		$descripcion = $fila["descripcion"];
		$stock = $fila["stock"];
		$salidas = $fila["salidas"];
		$entradas = $fila["entradas"];

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


	
	<div class="p-4 col-8 tamaño rounded position-absolute top-50 start-50 translate-middle fw-bold text-center mx-auto">
		<div class="titulo">
			<h2>Actualizacion de Inventario</h2>
		</div>
		<form class="row col-12 text-uppercase" action="<?=$_SERVER['PHP_SELF']?>" method="POST">	
			<div class="form-group p-1">
				<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			</div>
			<div class="form-group col-4 p-1">
				<label>Stock</label>
				<input class="form-control border border-dark" type="text" name="stock" value="<?php echo $stock; ?>">
			</div>
			<div class="form-group col-4 p-1">
				<label>Salidas</label>
				<input class="form-control border border-dark" type="text" name="salidas" value="<?php echo $salidas; ?>">
			</div>
			<div class="form-group col-4 p-1">
				<label>Entradas</label>
				<input class="form-control border border-dark" type="text" name="entradas" value="<?php echo $entradas; ?>">
			</div>
			<div class="form-group col-12 p-1">
				<label>Descripcion</label>
				<input class="form-control border border-dark" type="text" name="descripcion" value="<?php echo $descripcion; ?>">
			</div>
			<div class="d-grid py-2 gap-2 d-md-flex justify-content-md-end">
					<button class="btn btn-success" type="submit" name="enviar">Actualizar</button>
					<a class="btn btn-danger float-right" href="inventario.php">Cancelar</a>
			</div>
		</form>
	</div>
	<?php 
		}
	?>
</body>
</html>