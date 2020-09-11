<?php
	/*
		Created: 20 August 2020
		Test user with history: http://www.edacarquitectos.com/appBotonDePanico/PerceptionsHistory.php?id_usuario=1
		Test user null: http://www.edacarquitectos.com/appBotonDePanico/PerceptionsHistory.php?id_usuario=2
	*/
	include "conexion.php";

	$datosVacios["id_percepcion"]='';
    $datosVacios["latitud"]='';
    $datosVacios["longitud"]='';
    $datosVacios["valor_inseguridad"]='';
    $datosVacios["tipo_peligro"]='';
    $jsonVacio['datos'][]=$datosVacios;

	$id_usuario = $_GET["id_usuario"];
	
	$sql = "SELECT p.id_percepcion, p.latitud, p.longitud, p.valor_inseguridad, p.tipo_peligro FROM usuario u INNER JOIN percepcion p ON u.id_usuario = p.fk_usuario WHERE u.id_usuario = $id_usuario;";
	
	$query = mysqli_query($conexion, $sql);
	
	
	while($registros = mysqli_fetch_array($query)){
		$arreglo["datos"][] = array_map("utf8_encode", $registros);
	}
	
	if($arreglo == null){
		echo json_encode($jsonVacio);
	}else{
		echo json_encode($arreglo);
	}
	
	mysqli_close($conexion);
?>