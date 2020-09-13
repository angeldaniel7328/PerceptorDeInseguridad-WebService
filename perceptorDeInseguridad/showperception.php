<?php
	include "connection.php";

        //Para la face 2, cambiamos $_GET['latitud'] por $_GET['id_alarma']

	$pk_perception = $_POST['pk_perception'];

        //Tambien corregimos ...from alarma where latitud... por ...from alarma where id_alarma...

	$sql = "SELECT * FROM perceptions WHERE pk_perception = $pk_perception;";
	$query = mysqli_query($connection, $sql);
	while($records = mysqli_fetch_array($query)){
		$date_percepctions[] = array_map("utf8_encode", $records);
	}
	
	echo json_encode($date_percepctions);
	mysqli_close($connection);
?>