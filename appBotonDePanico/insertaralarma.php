<?php 
	include 'conexion.php';
	$longitud = $_GET['longitud'];
	$latitud = $_GET['latitud'];
        $valor_inseguridad = $_GET['valor_inseguridad'];
        $x = $_GET['x'];
        $y = $_GET['y'];
        $zona = $_GET['zona'];
        $hemisferio = $_GET['hemisferio'];
        $fk_usuario = $_GET['fk_usuario'];

	$sql = "insert into alarma (latitud, longitud, valor_inseguridad, x, y, zona, hemisferio, fk_usuario) values ($latitud, $longitud, $valor_inseguridad, $x, $y, $zona, '".$hemisferio."', $fk_usuario);";
	$query = mysqli_query($conexion, $sql);
	if ($query){
		echo "<h1>Se inserto el registro</h1>";
	}
	else{
		echo "<h1>No se inserto el registro</h1>";
	}
	mysqli_close($conexion);
?>