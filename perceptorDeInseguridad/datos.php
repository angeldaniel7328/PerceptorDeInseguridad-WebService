<?php
	include "conexion.php";
	$sql = "select * from alarma;";
	$query = mysqli_query($conexion, $sql);
	echo "<center>";
	echo "<table border=2>";
	echo "<tr>";
	echo "<th>ID<th>Fecha Hora<th>Latitud<th>Longitud<th>Percepcion";
	while($registros = mysqli_fetch_array($query))
	{
		echo "<tr>";
		echo "<td>".$registros['id_alarma'];
		echo "<td>".$registros['fecha_hora'];
		echo "<td>".$registros['latitud'];
		echo "<td>".$registros['longitud'];
		echo "<td>".$registros['valor_inseguridad'];
	}
	echo "</table>";
	echo "<center>";
	mysqli_close($conexion);
?>