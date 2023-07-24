<?php 
	$codigo = $_GET['codigo'];
	include("conex.php");

	$sql = "delete from inventario where codigo = '".$codigo."'";
	$resultado = mysqli_query($conexion,$sql);

	if ($resultado) {
		echo "<script languaje='JavaScript'> alert('Registro eliminado exitosamente');
				location.assign('inventario.php');</script>";
	}else{
		echo "<script languaje='JavaScript'> alert('Fallo al eliminar el registro');
				location.assign('inventario.php');</script>";
	}
?>