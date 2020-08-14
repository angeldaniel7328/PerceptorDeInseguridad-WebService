<?php
	include "conexion.php";

        //Para la face 2, cambiamos $_GET['latitud'] por $_GET['id_alarma']

	$id = $_GET['id_alarma'];

        //Tambien corregimos ...from alarma where latitud... por ...from alarma where id_alarma...

	$sql = "select * from alarma where id_alarma = $id";
	$query = mysqli_query($conexion, $sql);
	while($registros = mysqli_fetch_array($query))
	{
		$arreglo[] = array_map("utf8_encode", $registros);
	}
	
	echo json_encode($arreglo);
	mysqli_close($conexion);
?>