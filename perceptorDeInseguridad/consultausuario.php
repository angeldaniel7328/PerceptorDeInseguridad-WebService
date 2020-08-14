<?php
	include "conexion.php";
	$sql = "select * from usuario;";
	$query = mysqli_query($conexion, $sql);
	while($registros = mysqli_fetch_array($query))
	{
		$arreglo[] = array_map("utf8_encode", $registros);
	}
	
	echo json_encode($arreglo);
	mysqli_close($conexion);
?>