<?php
	include "connection.php";
	$sql = "select * from perceptions;";
	$query = mysqli_query($connection, $sql);
	while($records = mysqli_fetch_array($query))
	{
		$array[] = array_map("utf8_encode", $records);
	}
	echo json_encode($array);
	mysqli_close($connection);

	//for tests use this link.
    //  www.edacarquitectos.com/perceptorDeInseguridad/generalinquiry.php
?>