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

    //para realizar pruebas utilice este url
    //http://www.edacarquitectos.com/appBotonDePanico/checktime.php?id_usuario=3&x=3.3&3y=4.65

    //para insertar alarma utilice este url
    //www.edacarquitectos.com/appBotonDePanico/insertaralarma.php?latitud=1.1&longitud=2.2&valor_inseguridad=3&x=3.4345647543&y=2.4555555555&zona=14&hemisferio=norte&fk_usuario=3

    //para hacer pruebas en la BD utilice esta consulta
    /*
SELECT ((SELECT a.x FROM alarma a INNER JOIN usuario u ON a.fk_usuario = u.id_usuario WHERE u.id_usuario = 3 ORDER BY a.fecha_hora DESC LIMIT 1) BETWEEN 3.3-10 AND 3.3+10) OR (( SELECT a.y FROM alarma a INNER JOIN usuario u ON a.fk_usuario = u.id_usuario 
         WHERE u.id_usuario = 3 ORDER BY a.fecha_hora DESC LIMIT 1 ) BETWEEN 4.6-10 AND 4.6+10) AS rango_ubicacion, DATE_SUB(NOW(),INTERVAL 5 MINUTE) <= (SELECT a.fecha_hora FROM usuario u INNER JOIN alarma a ON u.id_usuario = a.fk_usuario WHERE u.id_usuario = 3 ORDER BY a.fecha_hora DESC LIMIT 1 ) AS rango_tiempo
    */
?>