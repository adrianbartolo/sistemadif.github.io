<?php 
	$norecibo = $_GET['norecibo'];
	include("conex.php");

	$sql = "delete from salidas where norecibo = '".$norecibo."'";
	$resultado = mysqli_query($conexion,$sql);

	if ($resultado) {
		echo "<script languaje='JavaScript'> alert('Registro eliminado exitosamente');
				location.assign('salidas.php');</script>";
	}else{
		echo "<script languaje='JavaScript'> alert('Fallo al eliminar el registro');
				location.assign('salidas.php');</script>";
	}
?>