<?php 
	$nofactura = $_GET['nofactura'];
	include("conex.php");

	$sql = "delete from entradas where nofactura = '".$nofactura."'";
	$resultado = mysqli_query($conexion,$sql);

	if ($resultado) {
		echo "<script languaje='JavaScript'> alert('Registro eliminado exitosamente');
				location.assign('entradas.php');</script>";
	}else{
		echo "<script languaje='JavaScript'> alert('Fallo al eliminar el registro');
				location.assign('entradas.php');</script>";
	}
?>