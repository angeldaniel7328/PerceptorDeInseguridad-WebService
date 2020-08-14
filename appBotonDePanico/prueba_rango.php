<?php
	include "conexion.php";
	$id_usuario= $_GET["id_usuario"];
        $x = $_GET["x"];
        $y = $_GET["y"];

	$sql = "SELECT (a.x BETWEEN $x-10 AND $x+10) OR (a.y BETWEEN $y-10 AND $y+10) AS rango_dia FROM alarma a INNER JOIN usuario u ON a.fk_usuario = u.id_usuario WHERE u.id_usuario = $id_usuario AND DATE(NOW()) = DATE(a.fecha_hora);";
	$query = mysqli_query($conexion, $sql);
        $bandera = "1";
        while($registros = mysqli_fetch_array($query))
	{     
                if ($registros['rango_dia'] == "1"){
                        $bandera = "0";
                }
		//$arreglo[] = array_map("utf8_encode", $registros);
	}
        if ($bandera == "1"){
             echo "Disponible";
        }
        else {
             echo "No disponible";
        }
	//echo json_encode($arreglo);
	mysqli_close($conexion);
?>