<?php
	/*
		Created: 20 August 2020
		Test user with history: http://www.edacarquitectos.com/appBotonDePanico/PerceptionsHistory.php?id_usuario=1
		Test user null: http://www.edacarquitectos.com/appBotonDePanico/PerceptionsHistory.php?id_usuario=2
	*/
	include "conexion.php";
	$id_usuario = $_GET["id_usuario"];
	
	$sql = "SELECT p.id_percepcion, p.latitud, p.longitud, p.fecha_hora, p.valor_inseguridad, p.x, p.y, p.zona, p.hemisferio, p.contexto, p.tipo_peligro FROM usuario u INNER JOIN percepcion p ON u.id_usuario = p.fk_usuario WHERE u.id_usuario = $id_usuario;";
	
	$query = mysqli_query($conexion, $sql);
	
	
	while($registros = mysqli_fetch_array($query)){
		$arreglo[] = array_map("utf8_encode", $registros);
	}
	
	if($arreglo == null){
		echo "SIN HISTORIAL";
	}else{
		echo json_encode($arreglo);
	}
	
	mysqli_close($conexion);
?>